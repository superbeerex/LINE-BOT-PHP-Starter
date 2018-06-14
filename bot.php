<?php
$access_token = 'iIgW22eHEFTTtQRq8KBYhiQR4ychqYvmjNatzo4Eq0uoCPGd6XHzMQ5XoilrnQsCVaasjUzpTfx90n8XvgJHgazYJ/vgZY3UEpF/Fof82iQuYFzYf5A/6hN3szFb4rw5gqzfybiA3TIhFAZdYJ9RFAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			$user_token = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			// Build message to reply back
			if (is_numeric($text)){
				$size = strlen($text);
				if ($size == 13) {
					$url = 'https://bcca.thaijobjob.com/201806/line/select.php'; // กำหนด URl
					$request = 'cus_id='.$text.''; // กำหนด HTTP Request โดยระบุ username=guest และ password=เguest (รูปแบบเหมือนการส่งค่า $_GET แต่ข้างหน้าข้อความไม่มีเครื่องหมาย ?)
					$ch = curl_init(); // เริ่มต้นใช้งาน cURL
					curl_setopt($ch, CURLOPT_URL, $url); // กำหนดค่า URL
					curl_setopt($ch, CURLOPT_POST, 1); // กำหนดรูปแบบการส่งข้อมูลเป็นแบบ $_POST
					curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // กำหนดค่า HTTP Request
					curl_setopt($ch, CURLOPT_HEADER, 0); // กำให้ cURL ไม่มีการตั้งค่า Header
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // กำหนดให้ cURL คืนค่าผลลัพท์
					$response = curl_exec($ch); // ประมวลผล cURL
					curl_close($ch); // ปิดการใช้งาน cURL

					// echo $response; // แสดงผลการทำงาน
					// $messages = [
					// 	'type' => 'text',
					// 	'text' => "เลขบัตรประจำตัวประชาชน: ".$text."\r\n".$response
					// ];
					$messages2 = [
						'type' => 'text',
							'text' => "เลขบัตรประจำตัวประชาชน: ".$text."\r\n".$response

					  // "template" => {
					  //     "type" => "confirm",
					  //     "text" => "Are you sure?",
					  //     "actions" => [
					  //         {
					  //           "type" => "message",
					  //           "label" => "Yes",
					  //           "text" => "yes"
					  //         },
					  //         {
					  //           "type" => "message",
					  //           "label" => "No",
					  //           "text" => "no"
					  //         }
					  //     ]
					  // }
					];
				} else {
					$messages = [
						'type' => 'text',
						'text' => "กรุณากรอกเลขบัตรประชาชน 13 หลัก"
					];
				}
			} else {
				$messages = [
					'type' => 'text',
					'text' => "กรุณากรอกเลขบัตรประชาชน 13 หลัก"
				];
      }

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages2],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>

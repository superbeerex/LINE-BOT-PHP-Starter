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
			if ($text == "hello") {
				$messages = [
					'type' => 'text',
<<<<<<< HEAD
					'text' => "สวัสดีคุณ User: $user_token",
					'text' => $text
=======
					'text' => "สวัสดีคุณ User: $user_token"
>>>>>>> a23c3f73c76042a59681273ecb2e95e59490685e
				];
			} else {
				$messages = [
					'type' => 'text',
					'text' => $text
				];
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
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

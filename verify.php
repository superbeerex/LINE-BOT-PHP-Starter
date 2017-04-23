<?php
$access_token = 'iIgW22eHEFTTtQRq8KBYhiQR4ychqYvmjNatzo4Eq0uoCPGd6XHzMQ5XoilrnQsCVaasjUzpTfx90n8XvgJHgazYJ/vgZY3UEpF/Fof82iQuYFzYf5A/6hN3szFb4rw5gqzfybiA3TIhFAZdYJ9RFAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

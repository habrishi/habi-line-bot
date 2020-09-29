<?php
$access_token = 'IvZukDGBwHdPtKzUbArMXq6nXzok07+ksXt4iIwpcaUulvY2T6RnWKNV7p9a9sOT1gNxb+/juDDUW8UnkoKCclxpc/18io19O2LjIVl9d6M966Zp7hK28QMDsO77QDBqsmvyv41NfkBV5we4a4reJAdB04t89/1O/w1cDnyilFU=';

$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:R5YfN2Bkou0igij';
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
//Input Files
$file = file('img.txt');
$num_lines = count($file);
$last_arr_index = $num_lines - 1;
$rand_index = rand(0, $last_arr_index);
$rand_text = $file[$rand_index];
//
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
			// Get replyToken
			$replyToken = $event['replyToken'];

			if($text == 'เบื่อจัง'){
				$messages = [
					'type' => 'image',
					'originalContentUrl' => $rand_text,
					'previewImageUrl' => $rand_text,
				];
			}else{
				// Build message to reply back
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
		}else if ($event['type'] == 'message' && $event['message']['type'] == 'image'){
			$image = $event['message']['image'];
			$replyToken = $event['replyToken'];

			$messages = [
				'type' => 'text',
				'text' => 'ส่งรูปเก่ง'

			];
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
		}else if ($event['type'] == 'message' && $event['message']['type'] == 'sticker'){
			$sticker = $event['message']['sticker'];
			$replyToken = $event['replyToken'];

			$messages = [
				'type' => 'sticker',
				'packageId' => '11537',
				'stickerId' => '52002756'

			];
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
}
?>
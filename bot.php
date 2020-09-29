﻿<?php
$access_token = 'IvZukDGBwHdPtKzUbArMXq6nXzok07+ksXt4iIwpcaUulvY2T6RnWKNV7p9a9sOT1gNxb+/juDDUW8UnkoKCclxpc/18io19O2LjIVl9d6M966Zp7hK28QMDsO77QDBqsmvyv41NfkBV5we4a4reJAdB04t89/1O/w1cDnyilFU=';

$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:R5YfN2Bkou0igij';
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
//Input Files
$file_meme = file('img.txt');
$file_stick = file('stickers.txt');
$file_pic = file('word_sendpic.txt');
$num_lines_meme = count($file_meme);
$num_lines_stick = count($file_stick);
$num_lines_pic = count($file_pic);
$last_arr_index_meme = $num_lines_meme - 1;
$last_arr_index_stick = $num_lines_stick - 1;
$last_arr_index_pic = $num_lines_pic - 1;
$rand_index_meme = rand(0, $last_arr_index_meme);
$rand_index_stick = rand(0, $last_arr_index_stick);
$rand_index_pic = rand(0, $last_arr_index_pic);
$rand_text_meme = $file_meme[$rand_index_meme];
$rand_text_stick = $file_stick[$rand_index_stick];
$rand_text_pic = $file_pic[$rand_index_pic];
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

			if ($text == "บอท" || $text == "บอทเหี้ย" || $text == "ไอ้น้อง" || $text == "น้อง" || $text == "น้อน"){
				$messages = [
					'type' => 'text',
					'text' => 'ไรมึง'
				];
			}
			else if ($text == "Meme" || $text == "มีม" || $text == "เบื่อจัง"){
				$messages = [
					'type' => 'image',
					'originalContentUrl' => $rand_text_meme,
					'previewImageUrl' => $rand_text_meme
				];
			}else if ($text == "หนังโป๊" || $text == "AV" || $text == "หี" || $text == "เงี่ยน" || $text == "ชมรม"){
				$messages = [
					'type' => 'audio',
					'originalContentUrl' => 'https://raw.githubusercontent.com/habrishi/habi-line-bot/master/audio/fun.m4a',
					'duration' => "15000"
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
				'text' => $rand_text_pic

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
				'stickerId' => $rand_text_stick

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
		echo "OK";
	}
}
?>
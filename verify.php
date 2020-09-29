<?php
$access_token = 'IvZukDGBwHdPtKzUbArMXq6nXzok07+ksXt4iIwpcaUulvY2T6RnWKNV7p9a9sOT1gNxb+/juDDUW8UnkoKCclxpc/18io19O2LjIVl9d6M966Zp7hK28QMDsO77QDBqsmvyv41NfkBV5we4a4reJAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array(   'Authorization: Bearer ' . $access_token);

$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:R5YfN2Bkou0igij';
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

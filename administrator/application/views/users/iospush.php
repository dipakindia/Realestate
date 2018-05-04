<?php

 function pushNotify($device_id,$_msg){
			//Put your device token here (without spaces):
			$deviceToken = '942ad229f0a324607026f58b1f50e53ba4438227495f33fdd1464fbf9a791dac';
			//$deviceToken = $device_id;
			//Put your private key's passphrase here:
			$passphrase = 'BreathTech123';
			//Put your alert message here:
			$message = $_msg;
			////////////////////////////////////////////////////////////////////////////////
			$ctx = stream_context_create();
			stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');
			stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
			// Open a connection to the APNS server
			$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2196', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
			//if (!$fp)
			//exit("Failed to connect: $err $errstr" . PHP_EOL);
			//echo 'Connected to APNS' . PHP_EOL;
			// Create the payload body
			$body = array('aps' => $message);
			// Encode the payload as JSON
			$payload = json_encode($body);
			// Build the binary notification
			$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
			// Send it to the server
			$result = fwrite($fp, $msg, strlen($msg));
			// Close the connection to the server
			fclose($fp);
			return $result;
   }	
   //echo 'sdgyvbhjnkl';
$data = pushNotify('fghjkl','rxdcfvgbh');  
?>
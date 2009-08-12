<?php
//paypal express checkout operation
	function PPHttpPost($methodName_, $nvpStr_) {
		$environment = 'live'; //or live
	
		// Set up your API credentials, PayPal end point, and API version.
		$API_UserName = urlencode('Dholte2391_api1.msn.com');
		$API_Password = urlencode('WQ8T9LD5AWP6NFAY');
		$API_Signature = urlencode('AfIrdy1KTmcPFtQvo6j3nUvvJlUiAsXxbtMGhxJrve76WioC9l5Fi1oi');
		$API_Endpoint = "https://api-3t.paypal.com/nvp";

		$version = urlencode('51.0');
	
		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	
		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
	
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
		// Get response from the server.
		$httpResponse = curl_exec($ch);
	
		if(!$httpResponse) {
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}
	
		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
	
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	
		return $httpParsedResponseAr;
	}

// Utility Functions
	function truncate($phrase, $max_words) {
		$phrase_array = explode(' ',$phrase);
		if(count($phrase_array) > $max_words && $max_words > 0)
			$phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
		return $phrase;
	}
	
	function echoItems($array) {
		if (is_array($array)) {
			foreach ($array as $item) {
				echo $item."\n";
			}
		}
	}
	
	function clean($me) {
		mysql_real_escape_string(stripslashes(trim($me)));
		return($me);
	}

	//function to encrypt the string
	function encode5t($str) {
		for($i=0; $i<5;$i++) {
			$str=strrev(base64_encode($str)); //apply base64 first and then reverse the string
	    }
	    return $str;
	}
	
	//function to decrypt the string
	function decode5t($str) {
		for($i=0; $i<5;$i++) {
			$str=base64_decode(strrev($str)); //apply base64 first and then reverse the string}
	    }
	    return $str;
	}
?>
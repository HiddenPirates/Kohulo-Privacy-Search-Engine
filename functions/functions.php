<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// -----------------------------------------------------------------

function sendMail($error_msg) {

	$mail = new PHPMailer(true);

	try {
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'YOUR_SMTP_USERNAME';        //SMTP username
	    $mail->Password   = 'YOUR_SMTP_PASSWORD';                         //SMTP password
	    $mail->SMTPSecure = 'tls';         							//Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    $mail->setFrom('from@example.com', 'Kohulo Search Engine');
	    $mail->addAddress('YOUR_SECOND_EMAIL_ID', 'Nur Alam');     	//Add a recipient

	    $mail->isHTML(true);                                  		//Set email format to HTML
	    $mail->Subject = 'Search Engine Server Error';
	    $mail->Body    = $error_msg;
	    $mail->AltBody = $error_msg;

	    $mail->send();
	    echo '<script>console.log("Message has been sent");</script>';
	} 
	catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo} <br> Please send this error sms manually to nura57764@gmail.com<br>".$error_msg;
	}
}

// -------------------------------------------------------------

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

// -----------------------------------------------------------

function getCountryCode($ip){

	$options = array(
			'http' => array(
				'method' => 'GET',
				'header' => 'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36',
			),
			
			'ssl' => [
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		    ],
		);

	$url = "http://geoplugin.net/json.gp?ip=".$ip;
	$context = stream_context_create($options);
	@$json_data = file_get_contents($url, false, $context);

	if (empty($json_data)) {
		return null;
	}
	else{
		$json_data = json_decode($json_data, true);
		$countryCode = $json_data['geoplugin_countryCode'];
		
		if ($countryCode == null) {
			return null;
		}
		else{
			return $countryCode;
		}
	}
}


// ------------------------------------------------------------

function isJson($string) {
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}
// -----------------------------------------------------------


function getSearchSuggestion($q) {

	$cc = getCountryCode(getUserIP());

	if ($cc == null) {
		$cc = "IN";
	}

	// $url = "https://duckduckgo.com/ac/?q=".str_replace(" ", "+", trim($q))."&kl=".$cc."-en";
	$url = "https://ac.ecosia.org/?q=".urlencode(trim($q))."&type=list&mkt=en-".$cc;

	$options = [
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_HEADER         => 0,
			    CURLOPT_FOLLOWLOCATION => 1,
			    CURLOPT_ENCODING       => '',
			    CURLOPT_COOKIEFILE     => '',
			    CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.72 Safari/537.36',
			    CURLOPT_SSL_VERIFYHOST => 0,
			    CURLOPT_SSL_VERIFYPEER => 0,
			];


	$ch = curl_init($url);
	curl_setopt_array($ch, $options);
	$json_data = curl_exec($ch);
	curl_close ($ch);

	if (empty($json_data)) {
		return null;
	}
	else{
		 if (isJson($json_data)) {
		 	return $json_data;
		 }
		 else{
		 	return null;
		 }
	}
}
// -------------------------------------------------------------------

function createLink($href,$url)
{	
	$scheme = parse_url($url)['scheme']; // http or https
	$host = parse_url($url)['host']; // www.w3schools.com

	if (substr($href, 0, 2) == "//") {
		$href = "http" . ":" . $href; 
	}
	else if (substr($href, 0, 1) == "/") {
		$href = $scheme . "://" . $host . $href; 
	}
	else if (substr($href, 0, 3) == "../") {
		$href = $scheme . "://" . $host . "/" . $href; 
	}
	else if (substr($href, 0, 2) == "./") {
		$href = $scheme . "://" . $host . dirname(parse_url($url)['path']) . substr($href, 1); 
	}
	else if ((substr($href, 0, 5) != "https") && (substr($href, 0, 4) != "http")) {
		$href = $scheme . "://" . $host . "/" . $href; 
	}

	return $href;
}

// ----------------------------------------------------------------------------------------------

function numberFormat($num) {

	$formatted_num = 0;

	if ($num > 999 && $num < 1000000) {
		
		$formatted_num = $num/1000;

		if (!is_int($formatted_num)) {
			
			$formatted_num = number_format($formatted_num,1);
			$formatted_num_str = (string) $formatted_num;

			if (substr($formatted_num_str, -1) == 0) {
				
				$formatted_num = (int) $formatted_num;
				return $formatted_num."K";
			}
			else{
				return $formatted_num."K";
			}
		}
		else{
			return $formatted_num."K";
		}
	}

	else if ($num > 999999 && $num < 1000000000) {
		
		$formatted_num = $num/1000000;

		if (!is_int($formatted_num)) {
			
			$formatted_num = number_format($formatted_num,1);
			$formatted_num_str = (string) $formatted_num;

			if (substr($formatted_num_str, -1) == 0) {
				
				$formatted_num = (int) $formatted_num;
				return $formatted_num."M";
			}
			else{
				return $formatted_num."M";
			}
		}
		else{
			return $formatted_num."M";
		}
	}

	else if ($num > 999999999) {
		
		$formatted_num = $num/1000000;

		if (!is_int($formatted_num)) {
			
			$formatted_num = number_format($formatted_num,1);
			$formatted_num_str = (string) $formatted_num;

			if (substr($formatted_num_str, -1) == 0) {
				
				$formatted_num = (int) $formatted_num;
				return $formatted_num."B";
			}
			else{
				return $formatted_num."B";
			}
		}
		else{
			return $formatted_num."B";
		}
	}
	else{
		return $num;
	}
}

// ------------------------------------------------------------------------------------------------

function visitedThisUserOrNot(){

	$cookie_name = "visited";
	$cookie_value = true;

	if (!isset($_COOKIE[$cookie_name])) {

		setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day

		if (checkCurrentDateInsertedOrNot()) {
			updateVisitorCounter();
		}
		else{
			insertVisitors();
		}
	}
	
}

// ----------------------------------------------------------------------------------------------


function getSafeSearchMode(){

	$cookie_name = "search-mode";

	if (isset($_COOKIE[$cookie_name])) {
		
		return $_COOKIE[$cookie_name];
	}
	else{
		return "off";
	}
}
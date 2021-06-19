<?php

class DomDocumentParser {

	private $doc;

	public function __construct($url,$search_page)
	{
		include('../extra-files/array_holder.php');
		include('../functions/functions.php');

		if ($search_page == "images_page") {

			$user_agent = $userAgents2[array_rand($userAgents2)];
		}
		else{

			$user_agent = $userAgents[array_rand($userAgents)];
		}


		$options = [
			    CURLOPT_RETURNTRANSFER 	=> 1,
			    CURLOPT_PROXYTYPE      	=> CURLPROXY_SOCKS5_HOSTNAME,
		    	CURLOPT_PROXY          	=> '127.0.0.1:9050',
			    CURLOPT_HEADER         	=> 0,
			    CURLOPT_FOLLOWLOCATION 	=> 1,
			    CURLOPT_ENCODING       	=> '',
			    CURLOPT_COOKIEFILE     	=> '',
			    CURLOPT_USERAGENT      	=> $user_agent,
			    CURLOPT_SSL_VERIFYHOST 	=> 0,
			    CURLOPT_SSL_VERIFYPEER 	=> 0,
			    CURLOPT_FAILONERROR	   	=> 1,
		];

		$ch = curl_init($url);
		curl_setopt_array($ch, $options);
		$html_data = curl_exec($ch);

		if (curl_errno($ch)) {
		    $error_msg = curl_error($ch);
		    echo $error_msg;
		}

		curl_close ($ch);

		$this->doc = new DomDocument();
		
		if ($html_data !== false) {

			$html_data = str_replace("UTF-8;charset=utf-8", "UTF-8", $html_data);
			$html_data = str_replace('&', '&amp;', $html_data);

			libxml_use_internal_errors(true);
			return $this->doc->loadHTML(mb_convert_encoding($html_data, 'HTML-ENTITIES', 'UTF-8'));
			libxml_clear_errors();
		}
		else{

			sleep(5);

			$ch = curl_init($url);
			curl_setopt_array($ch, $options);
			$html_data = curl_exec($ch);

			curl_close ($ch);

			if ($html_data !== false) {
				
				$html_data = str_replace("UTF-8;charset=utf-8", "UTF-8", $html_data);
				$html_data = str_replace('&', '&amp;', $html_data);

				libxml_use_internal_errors(true);
				return $this->doc->loadHTML(mb_convert_encoding($html_data, 'HTML-ENTITIES', 'UTF-8'));
				libxml_clear_errors();
			}
			else{
				sendMail("Bot blocked By Bing");
				echo "Bot blocked. :(";
			}
		}
		
	}



	public function getElementsByClassName($className)
	{
	    $finder = new DomXPath($this->doc);
	    $spaner = $finder->query("//*[contains(@class, '$className')]");

		return $spaner;
	}
}
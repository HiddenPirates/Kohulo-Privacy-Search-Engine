<?php

ob_start();
ini_set('max_execution_time', 0);

include('../classes/parser.php');

if (!isset($_POST['query']) && !isset($_POST['page']) && !isset($_POST['api-token'])) {
    die('invalid access.00');
}
elseif (empty($_POST['query']) || empty($_POST['api-token']) || empty($_POST['page'])) {
    die('invalid access.01');
}
elseif (!is_int($_POST['page']) && $_POST['api-token'] !== "2468543210nuralam543210") {
    die('invalid access.02');
}


$query = str_replace(" ", "+", htmlspecialchars(trim($_POST['query'])));
$first = (($_POST['page']-1)*10)+1;

$url = "https://in.news.search.yahoo.com/search?p=".$query."&vm=r&fr=yfp-t&fr2=sb-top-in.news.search&b=".$first."&pz=10&xargs=0";

$news_informations = array();

function getDetails($url)
{
	global $news_informations;

	$search_page = "news_page";

	$parser = new DomDocumentParser($url,$search_page);

	$newsInfoContainerLis = $parser->getElementsByClassName('ov-a fst');

	if ((sizeof($newsInfoContainerLis) !== 0)) {

		foreach ($newsInfoContainerLis as $newsInfoContainerLi) {

			$news_thumb = "";
			$news_link = "";
			$news_title = "";
			$news_description = "";
			$news_published_time = "";
			$news_owner_website_name = "";
			
			$tmp_dom = new DOMDocument();
			$tmp_dom->appendChild($tmp_dom->importNode($newsInfoContainerLi,true));
			$innerHTML = trim($tmp_dom->saveHTML());

			$imgTags = $tmp_dom->getElementsBytagName("img");
		    $aTags = $tmp_dom->getElementsBytagName("a");
		    $h4Tags = $tmp_dom->getElementsBytagName("h4");
		    $spanTags = $tmp_dom->getElementsBytagName("span");
		    $pTags = $tmp_dom->getElementsBytagName("p");

		    foreach ($spanTags as $spanTag) {
		    	if ($spanTag->getAttribute('class') == "s-source mr-5 cite-co") {
		    		$news_owner_website_name = $spanTag->nodeValue;
		    		// echo $news_owner_website_name . "<br>";
		    	}
		    	else if ($spanTag->getAttribute('class') == "fc-2nd s-time mr-8") {
		    		$news_published_time = $spanTag->nodeValue;
		    		// echo $news_published_time . "<br>";
		    	}
		    }

		    foreach ($aTags as $aTag) {
		    	if ($aTag->getAttribute('class') == "thmb ") {	
		    		$news_link = $aTag->getAttribute('href');
		    	}
		    }

		    foreach ($imgTags as $imgTag) {

		    	if ($imgTag->getAttribute('class') == "s-img hidden") {
		    		$news_thumb = $imgTag->getAttribute('data-src');
		    	}
		    }

		    foreach ($h4Tags as $h4Tag) {
		    	if ($h4Tag->getAttribute('class') == "s-title fz-16 lh-20") {
		    		$news_title = $h4Tag->nodeValue;
		    	}
		    }

		    foreach ($pTags as $pTag) {

		    	if ($pTag->getAttribute('class') == "s-desc") {

		    		$tmp_dom2 = new DOMDocument();
					$tmp_dom2->appendChild($tmp_dom2->importNode($pTag,true));
					$innerHTML2 = trim($tmp_dom2->saveHTML());

		    		$news_description = $innerHTML2;

		    	}
		    }

			
			if ($news_thumb !== "" && $news_title !== "" && $news_link !== "" && $news_description !== "" && $news_owner_website_name !== "" && $news_published_time !== "") {
				
				$news_informations[] = array(
					"news_thumb" => $news_thumb,
					"news_title" => $news_title,
					"news_link" => $news_link,
					"news_description" => html_entity_decode($news_description),
					"news_owner_website_name" => $news_owner_website_name,
					"news_published_time" => $news_published_time,
				);
			}
		}
	}
}

getDetails($url);

header('Content-Type: application/json');
$news_informations = json_encode($news_informations,JSON_FORCE_OBJECT);
echo $news_informations;
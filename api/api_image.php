<?php

ob_start();
ini_set('max_execution_time', 0);

include('../classes/parser.php');

// -------------------------------------------------------------------------------------
if (!isset($_POST['query']) && !isset($_POST['page']) && !isset($_POST['api-token']) && !isset($_POST['cc']) && !isset($_POST['safesearch'])) {
	die('invalid access.00');
}
elseif (empty($_POST['query']) || empty($_POST['api-token']) || empty($_POST['cc']) || empty($_POST['safesearch']) || empty($_POST['page'])) {
	die('invalid access.01');
}
elseif (!is_int($_POST['page']) && $_POST['api-token'] !== "2468543210nuralam543210") {
	die('invalid access.02');
}

// ----------------------

if ($_POST['safesearch'] == "moderate") {
	$safesearch = $_POST['safesearch'];
}
elseif ($_POST['safesearch'] == "strict") {
	$safesearch = $_POST['safesearch'];
}
else{
	$safesearch = "off";
}

// ----------------------
$query = urlencode(trim($_POST['query']));
$first = (($_POST['page']-1)*10)+1;
$cc = $_POST['cc'];
$count = 80;
// -----------------------

// $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
// $txt = $first." = ";
// fwrite($myfile, $txt);
// $txt = $_POST['page']."\n";
// fwrite($myfile, $txt);
// fclose($myfile);

if (isset($_POST['show-only'])) {
	$url = "https://www.bing.com/images/search?q=+".$query."&first=".$first."&mkt=en-".$cc."&tsc=ImageBasicHover&adlt=".$safesearch."&FORM=HDRSC2&count=".$count;
}
else{
	$url = "https://www.bing.com/images/search?q=".$query."&first=".$first."&mkt=en-".$cc."&tsc=ImageBasicHover&adlt=".$safesearch."&FORM=HDRSC2&count=".$count;
}
// -------------------------------------------------------------------------------------

$imageInfos = array();
$rightWords = "";

function getDetails($url)
{
	global $imageInfos;
	global $rightWords;

	$search_page = "images_page";

	$parser = new DomDocumentParser($url,$search_page);

	$imageInfoContainerDivs = $parser->getElementsByClassName('imgpt');
	$rightWordsDivs = $parser->getElementsByClassName(' mmrq2');


	if ((sizeof($imageInfoContainerDivs) !== 0)) {

		foreach ($imageInfoContainerDivs as $imageInfoContainerDiv) {

			$imageThumb = "";
			$mainImageSrc = "";
			$imageResolution = "";
			$pageLink = "";
			$imageOwnerWebLink = "";
			$img_width = "";
			$img_height = "";
			
			$tmp_dom = new DOMDocument();
			$tmp_dom->appendChild($tmp_dom->importNode($imageInfoContainerDiv,true));
			$innerHTML = trim($tmp_dom->saveHTML());

			$imgTags = $tmp_dom->getElementsBytagName("img");
		    $aTags = $tmp_dom->getElementsBytagName("a");
		    $spanTags = $tmp_dom->getElementsBytagName("span");

		    $finder = new DomXPath($tmp_dom);
		    $contents = $finder->query("//*[contains(@class, 'img_cont hoff')]");

		    foreach ($spanTags as $spanTag) {
		    	
		    	if ($spanTag->getAttribute('class') == "nowrap") {

		    		$imageResolution = $spanTag->nodeValue;

		    		$img_width = trim(explode(" ", $imageResolution)[0]);
		    		$img_height = trim(explode(" ", $imageResolution)[2]);
		    	}
		    }

		    foreach ($aTags as $aTag) {

		    	if ($aTag->getAttribute('class') == "iusc") {
		    		
		    		$bingLink = $aTag->getAttribute('href');
		    		$bingLink = urldecode(createLink($bingLink,"https://www.bing.com"));
		    		$url_components = parse_url($bingLink);
		    		parse_str($url_components['query'], $params);

		    		if (array_key_exists("riu",$params)) {
		    			$mainImageSrc = $params['riu'];
		    		}
		    		else{
		    			$mainImageSrc = $params['amp;mediaurl'];
		    		}
		    	}

		    	if ($aTag->getAttribute('data-hookid') == "pgdom") {
		    		$pageLink = $aTag->getAttribute('href');
		    		$imageOwnerWebLink = $aTag->nodeValue;
		    	}
		    }

		    foreach ($contents as $content) {

		    	$tmp_dom2 = new DOMDocument();
				$tmp_dom2->appendChild($tmp_dom2->importNode($content,true));
				$innerHTML2 = trim($tmp_dom2->saveHTML());

				$imageTags = $tmp_dom2->getElementsByTagName('img');

				foreach ($imageTags as $img) {

					if ($img->getAttribute('data-src')) {
						$imageThumb = $img->getAttribute('data-src');
					}
				}
		    }

			
			if ($imageThumb !== "" && $mainImageSrc !== "" && $pageLink !== "" && $imageResolution !== "" && $imageOwnerWebLink !== "") {
				
				$imageInfos[] = array(
					"image_thumbnail" => $imageThumb,
					"mainImageSrc" => $mainImageSrc,
					"pageLink" => $pageLink,
					"imageResolution" => $imageResolution,
					"image_width" => $img_width,
					"image_height" => $img_height,
					"imageOwnerWebLink" => $imageOwnerWebLink
				);
			}
		}

		// -------------------------------------------

		foreach ($rightWordsDivs as $rightWordsDiv) {

			foreach ($rightWordsDiv->childNodes as $childNode) {

				if (isset($childNode->tagName)) {

					if ($childNode->tagName == "a") {
						$rightWords = $childNode->nodeValue;
					}
				}
			}
		}
	}
}

getDetails($url);

$allResults = array("right_key_words" => $rightWords, "image_informations" => $imageInfos);
$allResults = json_encode($allResults,JSON_FORCE_OBJECT);

echo $allResults;
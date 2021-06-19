<?php

ob_start();
ini_set('max_execution_time', 0);

include('../classes/parser.php');

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

// -----------------------

if (isset($_POST['show-only'])) {
	$url = 'https://www.bing.com/search?q=+'.$query.'&first='.$first.'&safesearch='.$safesearch.'&cc='.$_POST["cc"].'&filters=rcrse:"1"&FORM=RCRE';
}
else{
	$url = "https://www.bing.com/search?q=".$query."&first=".$first."&safesearch=".$safesearch."&cc=".$_POST['cc'];
}


// -----------------------

$alreadyCrawled = array();
$rightWords = "";
$relatedSearchesKeywords = array();
$instantResult = array();
$instantResultWikiInfo = "";
$imageAnsDiv = false;
$videoAnsDiv = false;
$newsAnsDiv = false;

function getDetails($url)
{
	global $alreadyCrawled;
	global $rightWords;
	global $relatedSearchesKeywords;
	global $instantResult;
	global $instantResultWikiInfo;
	global $imageAnsDiv;
	global $videoAnsDiv;
	global $newsAnsDiv;

	$search_page = "web_page";

	$parser = new DomDocumentParser($url,$search_page);

	$liTagsForResults = $parser->getElementsByClassName('b_algo');
	$liTagsForWordSuggestion = $parser->getElementsByClassName('b_promtxt');
	$ulTagsForRelatedSearch = $parser->getElementsByClassName('b_vList b_divsec');
	$instantResultDivs = $parser->getElementsByClassName('df_con');
	$wikipedia_info_divs = $parser->getElementsByClassName('b_subModule');
	$imageAnswerDivs = $parser->getElementsByClassName('imgAns');
	$videoAnswerDivs = $parser->getElementsByClassName('vsathm');
	$newsAnswerDivs = $parser->getElementsByClassName('ans_nws');

	if ((sizeof($liTagsForResults) !== 0)) {

		foreach ($liTagsForResults as $liTag) {

			$title = ""; 
			$link = ""; 
			$description = "";
			$sublinks = array();

			$tmp_dom = new DOMDocument();
			$tmp_dom->appendChild($tmp_dom->importNode($liTag,true));
			$innerHTML = trim($tmp_dom->saveHTML());

			libxml_use_internal_errors(true);
			$tmp_dom->loadHTML(mb_convert_encoding($innerHTML, 'HTML-ENTITIES', 'UTF-8'));
			libxml_clear_errors();

			$h2Tags = $tmp_dom->getElementsByTagName('h2');
			$pTags = $tmp_dom->getElementsByTagName('p');
			$olTags = $tmp_dom->getElementsByTagName('ol');
			$ulTags = $tmp_dom->getElementsByTagName('ul');

			$finder = new DomXPath($tmp_dom);
		    $contents = $finder->query("//*[contains(@class, 'b_vlist2col b_deep')]");

// ==============================================================
		    foreach ($contents as $content) {
		    	
		    	$tmp_dom2 = new DOMDocument();
				$tmp_dom2->appendChild($tmp_dom2->importNode($content,true));
				$innerHTML2 = trim($tmp_dom2->saveHTML());

				libxml_use_internal_errors(true);
				$tmp_dom2->loadHTML(mb_convert_encoding($innerHTML2, 'HTML-ENTITIES', 'UTF-8'));
				libxml_clear_errors();

				$aTags = $tmp_dom2->getElementsByTagName('a');

				
				$sublinkTitle = "";
				$subLinkUrl = "";
// ==============================================================
				foreach ($aTags as $aTag) {

					$sublinkTitle = trim($aTag->nodeValue);
					$subLinkUrl = $aTag->getAttribute('href');

					if ($sublinkTitle !== "" && $subLinkUrl !== "") {
						$sublinks[] = array("sublinkTitle" => $sublinkTitle, "subLinkUrl" => $subLinkUrl);
					}
				}
		    }


// ==============================================================
			foreach ($h2Tags as $h2Tag) {
				
				if (isset($h2Tag->firstChild) && isset($h2Tag->firstChild->tagName) && $h2Tag->firstChild->tagName == "a") {

					$title = trim($h2Tag->firstChild->nodeValue);
					$link = $h2Tag->firstChild->getAttribute('href');
				}
			}
// ==============================================================
			if (sizeof($olTags)  !== 0) {
				
				foreach ($olTags as $olTag) {

					if ($olTag->getAttribute("class") == "b_dList") {
						
						$tmp_dom2 = new DOMDocument();
						$tmp_dom2->appendChild($tmp_dom2->importNode($olTag,true));
						$innerHTML2 = trim($tmp_dom2->saveHTML());
						$description = $innerHTML2;
						break;
					}
				}
			}

			if (sizeof($ulTags)  !== 0) {
				
				foreach ($ulTags as $ulTag) {

					if ($ulTag->getAttribute("class") == "b_vList b_divsec b_bullet") {
						
						$tmp_dom2 = new DOMDocument();
						$tmp_dom2->appendChild($tmp_dom2->importNode($ulTag,true));
						$innerHTML2 = trim($tmp_dom2->saveHTML());
						$description = $innerHTML2;
						break;
					}
				}
			}

			if (sizeof($pTags) > 0) {
				
				foreach ($pTags as $pTag) {
					// $description = trim($pTag->nodeValue);
					// break;
					$tmp_dom2 = new DOMDocument();
					$tmp_dom2->appendChild($tmp_dom2->importNode($pTag,true));
					$innerHTML2 = trim($tmp_dom2->saveHTML());
					$description = $innerHTML2;
					break;
				}
			}

			// ==============================================================
			if ($title !== "" && $link !== "" && $description !== "") {

				$result = array("title" => $title, "link" => $link, "description" => html_entity_decode($description), "subLinks" => $sublinks);
				$alreadyCrawled[] = $result;
				
			}
			// ==============================================================
		}

		// -----------------------------------------------------------------------------------------
		if (sizeof($instantResultDivs) !== 0) {

			$instantResultText = " ";
			$instantResultTitle = "";
			$instantResultLink = "";
			$instantResultHtml = "";
			
			foreach ($instantResultDivs as $instantResultDiv) {
				
				$tmp_dom3 = new DOMDocument();
				$tmp_dom3->appendChild($tmp_dom3->importNode($instantResultDiv,true));
				$innerHTML3 = trim($tmp_dom3->saveHTML());

				libxml_use_internal_errors(true);
				$tmp_dom3->loadHTML(mb_convert_encoding($innerHTML3, 'HTML-ENTITIES', 'UTF-8'));
				libxml_clear_errors();

				$finder2 = new DomXPath($tmp_dom3);
			    $contents2 = $finder2->query("//*[contains(@class, 'rwrl rwrl_pri rwrl_padref')]");
			    $contents3 = $finder2->query("//*[contains(@class, 'rwrl rwrl_sec rwrl_padref')]");

			    $h2Tags2 = $tmp_dom3->getElementsByTagName('h2');

			    foreach ($contents2 as $content2) {

			    	foreach ($content2->childNodes as $content2ChildNode) {

						if (isset($content2ChildNode->wholeText)) {
							$instantResultText = $instantResultText . trim($content2ChildNode->wholeText) . " ";
						}

						if (isset($content2ChildNode->tagName)) {
							
							if ($content2ChildNode->tagName == "strong" || $content2ChildNode->tagName == "b") {
								$instantResultText = $instantResultText . "#####" . trim($content2ChildNode->nodeValue) . "***** ";
							}

							if ($content2ChildNode->tagName == "ol" || $content2ChildNode->tagName == "ul") {
								
								$tmp_dom4 = new DOMDocument();
								$tmp_dom4->appendChild($tmp_dom4->importNode($content2ChildNode,true));
								$innerHTML4 = trim($tmp_dom4->saveHTML());

								$instantResultHtml = $innerHTML4;
							}
						}
			    	}
			    }

			    foreach ($contents3 as $content2) {
			    	
			    	foreach ($content2->childNodes as $content2ChildNode) {

						if (isset($content2ChildNode->wholeText)) {
							$instantResultText = $instantResultText . trim($content2ChildNode->wholeText) . " ";
						}

						if (isset($content2ChildNode->tagName)) {
							
							if ($content2ChildNode->tagName == "strong" || $content2ChildNode->tagName == "b") {
								$instantResultText = $instantResultText . "#####" . trim($content2ChildNode->nodeValue) . "***** ";
							}

							if ($content2ChildNode->tagName == "ol" || $content2ChildNode->tagName == "ul") {
								
								$tmp_dom4 = new DOMDocument();
								$tmp_dom4->appendChild($tmp_dom4->importNode($content2ChildNode,true));
								$innerHTML4 = trim($tmp_dom4->saveHTML());

								$instantResultHtml = $innerHTML4;
							}
						}
			    	}
			    }

			    foreach ($h2Tags2 as $h2Tag2) {

			    	if (isset($h2Tag2->firstChild->tagName)) {

			    		if ($h2Tag2->firstChild->tagName == "a") {

			    			$instantResultTitle = $h2Tag2->firstChild->nodeValue;
			    			$instantResultLink = $h2Tag2->firstChild->getAttribute('href');
			    		}
			    	}
			    }
			}

			if ($instantResultHtml !== "") {

				$instantResultHtml = html_entity_decode($instantResultHtml);
				$instantResultText = trim($instantResultHtml);
			}

			$instantResultText =  trim($instantResultText);
			
			if ($instantResultText !== "" && $instantResultTitle !== "" && $instantResultLink !== "") {
				$instantResult = array("title" => $instantResultTitle, "link" => html_entity_decode($instantResultLink), "text" => $instantResultText);
			}
		}
// ---------------------------------------------------------------------------------------------------

		if (sizeof($wikipedia_info_divs) !== 0) {
			
			foreach ($wikipedia_info_divs as $wikipedia_info_div) {

				if (isset($wikipedia_info_div->firstChild->tagName)) {
					
					if ($wikipedia_info_div->firstChild->tagName == "h2") {

						if ($wikipedia_info_div->firstChild->getAttribute("class") == " b_entityTitle") {

							$wiki_info_div_title = "";
							$wiki_info_div_identity = "";
							$wiki_info_div_texts = "";
							$wiki_info_div_links = array();
							$wiki_info_div_lists = array();
							
							$temp_dom = new DOMDocument();
							$temp_dom->appendChild($temp_dom->importNode($wikipedia_info_div,true));
							$innerHTMLs = trim($temp_dom->saveHTML());

							libxml_use_internal_errors(true);
							$temp_dom->loadHTML(mb_convert_encoding($innerHTMLs, 'HTML-ENTITIES', 'UTF-8'));
							libxml_clear_errors();

							$h2TagsInWikiDiv = $temp_dom->getElementsByTagName('h2');
							$divTagsInWikiDiv = $temp_dom->getElementsByTagName('div');
							$spanTagsInWikiDiv = $temp_dom->getElementsByTagName('span');
							$ulTagsInWikiDiv = $temp_dom->getElementsByTagName('ul');

							foreach ($h2TagsInWikiDiv as $h2TagInWikiDiv) {
								
								if ($h2TagInWikiDiv->getAttribute("class") == " b_entityTitle") {
									$wiki_info_div_title = trim($h2TagInWikiDiv->nodeValue);
								}
							}

							foreach ($divTagsInWikiDiv as $divTagInWikiDiv) {
								
								if ($divTagInWikiDiv->getAttribute("class") == "b_entitySubTitle") {
									$wiki_info_div_identity = trim($divTagInWikiDiv->nodeValue);
								}

								
								if ($divTagInWikiDiv->getAttribute("class") == "b_hide") {

									if (isset($divTagInWikiDiv->firstChild->tagName)) {
										if ($divTagInWikiDiv->firstChild->tagName == "span") {
											$wiki_info_div_texts = trim($divTagInWikiDiv->nodeValue);
											// echo "<script>console.log('12+{$wiki_info_div_texts}'')</script>";
										}
									}
								}

								if ($wiki_info_div_texts == "") {
									
									if ($divTagInWikiDiv->getAttribute("class") == "b_lBottom b_snippet") {
										$wiki_info_div_texts = trim($divTagInWikiDiv->nodeValue);
									}
								}
							}

							foreach ($ulTagsInWikiDiv as $ulTagInWikiDiv) {
								
								if ($ulTagInWikiDiv->getAttribute("class") == "b_hList") {
								
									$temp_dom2 = new DOMDocument();
									$temp_dom2->appendChild($temp_dom2->importNode($ulTagInWikiDiv,true));
									$innerHTMLs2 = trim($temp_dom2->saveHTML());

									libxml_use_internal_errors(true);
									$temp_dom2->loadHTML(mb_convert_encoding($innerHTMLs2, 'HTML-ENTITIES', 'UTF-8'));
									libxml_clear_errors();

									$allLiTags = $temp_dom2->getElementsByTagName('li');

									
									foreach ($allLiTags as $allLiTag) {

										foreach ($allLiTag->childNodes as $liTagChild) {
											
											$link_title = "";
											$link = "";

											if (isset($liTagChild->tagName)) {
												
												if ($liTagChild->tagName == "a") {

													$link = $liTagChild->getAttribute("href");
													$link_title = $liTagChild->nodeValue;
												}
											}

											$wiki_info_div_links[] = array("link_title" => $link_title, "link" => $link);
										}
									}
								}

								// ....................

								if ($ulTagInWikiDiv->getAttribute("class") == "b_vList b_divsec") {

									$temp_dom2 = new DOMDocument();
									$temp_dom2->appendChild($temp_dom2->importNode($ulTagInWikiDiv,true));
									$innerHTMLs2 = trim($temp_dom2->saveHTML());

									libxml_use_internal_errors(true);
									$temp_dom2->loadHTML(mb_convert_encoding($innerHTMLs2, 'HTML-ENTITIES', 'UTF-8'));
									libxml_clear_errors();

									$allDivTags = $temp_dom2->getElementsByTagName('div');
									// $allSpanTags = $temp_dom2->getElementsByTagName('span');

									foreach ($allDivTags as $allDivTag) {

										if ($allDivTag->getAttribute("class") == "b_factrow") {
											
											foreach ($allDivTag->childNodes as $divTagChild) {

												$list_points = "";
												$list_describe = "";

												if (isset($divTagChild->tagName)) {
													
													if ($divTagChild->tagName == "span") {

														if ($divTagChild->getAttribute("class") == "cbl b_lower") {

															$list_points =  $divTagChild->nodeValue;
															$list_describe = str_replace($list_points, "", $allDivTag->nodeValue);

															$wiki_info_div_lists[] = array("title" => trim($list_points), "description" => trim($list_describe));
														}
													}
												}
											}
										}										
									}
								}
							}

							
							
							// .....................

							if ($wiki_info_div_title !== "" && $wiki_info_div_identity !== "" && $wiki_info_div_texts !== "") {
								
								$instantResultWikiInfo = array(

									"wiki_info_div_title" => trim($wiki_info_div_title),
									"wiki_info_div_identity" => trim($wiki_info_div_identity),
									"wiki_info_div_texts" => trim($wiki_info_div_texts),
									"wiki_info_div_links" => $wiki_info_div_links,
									"wiki_info_div_lists" => $wiki_info_div_lists,

								);
							}

						// 555555
						}
					}
				}
			}
		}
		

// ----------------------------------------------------------------------------------------
		if (sizeof($imageAnswerDivs) > 0) {
			$imageAnsDiv = true;
		}
		if (sizeof($videoAnswerDivs) > 0) {
			$videoAnsDiv = true;
		}
		if (sizeof($newsAnswerDivs) > 0) {
			$newsAnsDiv = true;
		}
// ----------------------------------------------------------------------------------------

		foreach ($ulTagsForRelatedSearch as $ulTagForRelatedSearch) {
			
			foreach ($ulTagForRelatedSearch->childNodes as $childNode) {

				foreach ($childNode->childNodes as $childNode2) {

					if (isset($childNode2->tagName) && $childNode2->tagName == "a") {
						$relatedSearchesKeywords[] = $childNode2->nodeValue;
					}
				}
			}
		}

// ----------------------------------------------------------------------------------------

	}

// ------------------------------------------------------------------


	if ((sizeof($liTagsForWordSuggestion) !== 0)) {

		foreach ($liTagsForWordSuggestion as $key) {

			if (strpos($key->nodeValue, 'Including results for') !== false) {

			   $rightWords = str_replace("Including results for", "", $key->nodeValue);

			   if (substr($rightWords, -1) == ".") {
			   		$rightWords = trim(substr_replace($rightWords, "", -1));
			   }
			}
		}
	}
}

getDetails($url);

$alreadyCrawled = array_unique($alreadyCrawled, SORT_REGULAR);

$allResults = array(

				"image_slider" => $imageAnsDiv,
				"video_slider" => $videoAnsDiv,
				"news_slider" => $newsAnsDiv,
				"instant_Result_Wiki_Info" => $instantResultWikiInfo, 
				"instant_result" => $instantResult, 
				"right_words" => $rightWords, 
				"related_searches" => $relatedSearchesKeywords, 
				"search_results" => $alreadyCrawled
			);


$allResults = json_encode($allResults,JSON_FORCE_OBJECT);
header('Content-Type: application/json');
echo $allResults;

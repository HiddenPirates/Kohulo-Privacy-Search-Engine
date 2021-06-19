<?php

function getSiteMetaInfo(){
	
	global $con;

	$query = $con->prepare("SELECT * FROM site_meta_info WHERE id = 1");
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return null;
	}
	else{
		return $row;
	}
}

// ------------------------------------------------


function getSiteSearchBarPlaceholder(){
	
	global $con;

	$query = $con->prepare("SELECT * FROM search_bar_placeholder WHERE id = 1");
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		echo "Search the internet faster...";
	}
	else{
		echo $row['value'];
	}
}

// ------------------------------------------------


function getSocialLinks(){
	
	global $con;

	$query = $con->prepare("SELECT * FROM social_links WHERE id = 1");
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return null;
	}
	else{
		return $row;
	}
}

// ------------------------------------------------


function getPageData($page_name){

	global $con;

	$query = $con->prepare("SELECT * FROM site_pages WHERE page_name LIKE :page_name");

	$query->bindParam(':page_name', $page_name);
	
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return null;
	}
	else{
		return $row;
	}
}


  // --------------------------------------------------------//
 //						Visitors Functions 					//
// --------------------------------------------------------//


function checkCurrentDateInsertedOrNot(){
	
	global $con;

	$query = $con->prepare("SELECT * FROM visitors_counter WHERE DATE(time_and_date) = CURDATE()");

	$query->execute();

	if ($query->rowCount() == 0) {
		return false;
	}
	else{
		return true;
	}
}


function insertVisitors(){

	global $con;

	$query = $con->prepare("INSERT INTO visitors_counter(total_visitors) VALUES (1)");

	$query->execute();
}


function updateVisitorCounter(){

	global $con;

	$total_number;

	$query = $con->prepare("SELECT * FROM visitors_counter WHERE DATE(time_and_date) = CURDATE()");
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		die('<script>document.write("Internal Error.");</script>');
	}
	else{
		$total_number = $row['total_visitors']+1;
	}

	$query2 = $con->prepare("UPDATE visitors_counter SET total_visitors = {$total_number} WHERE DATE(time_and_date) = CURDATE()");
	$query2->execute();
}
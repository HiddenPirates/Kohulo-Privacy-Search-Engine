<?php

function validateLogin($username,$password){

	global $con;

	$query = $con->prepare("SELECT * FROM admin_login WHERE username = :username AND password = :password");

	$query->bindParam(':username', $username);
	$query->bindParam(':password', $password);
	$query->execute();

	return $query->rowCount() != 0;
}

// --------------------------------------------------------


function updateSiteMetaInfo($title, $description, $keywords){

	global $con;

	$query = $con->prepare("UPDATE site_meta_info SET site_title = :title, site_description = :description, site_keywords = :keywords WHERE id = 1");

	$query->bindParam(':title', $title);
	$query->bindParam(':description', $description);
	$query->bindParam(':keywords', $keywords);

	return $query->execute();
}

// --------------------------------------------------------


function updatePlaceholder($search_box_placeholder){

	global $con;

	$query = $con->prepare("UPDATE search_bar_placeholder SET value = :search_box_placeholder WHERE id = 1");

	$query->bindParam(':search_box_placeholder', $search_box_placeholder);

	return $query->execute();
}

// ---------------------------------------------------------


function updateUsernameAndPassword($new_username, $new_password, $old_username, $old_password){

	global $con;

	if (validateLogin($old_username,$old_password)) {
		
		$query2 = $con->prepare("UPDATE admin_login SET username = :new_username, password = :new_password WHERE id = 1");

		$query2->bindParam(':new_username', $new_username);
		$query2->bindParam(':new_password', $new_password);

		return $query2->execute();
	}
	else{
		return false;
	}
}

// ---------------------------------------------------------------


function updateSocialLinks($facebook, $github, $youtube, $instagram){

	global $con;

	if (empty($facebook)) {
		$facebook = "no link";
	}
	if (empty($github)) {
		$github = "no link";
	}
	if (empty($instagram)) {
		$instagram = "no link";
	}
	if (empty($youtube)) {
		$youtube = "no link";
	}


	$query = $con->prepare("UPDATE social_links 
		SET github = :github, facebook = :facebook, instagram = :instagram, youtube = :youtube 
		WHERE id = 1"
	);

	$query->bindParam(':facebook', $facebook);
	$query->bindParam(':github', $github);
	$query->bindParam(':youtube', $youtube);
	$query->bindParam(':instagram', $instagram);

	return $query->execute();

}


function checkPageExists($page_name){
	
	global $con;

	$query = $con->prepare("SELECT * FROM site_pages WHERE page_name LIKE :page_name");
	$query->bindParam(':page_name', $page_name);
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return false;
	}
	else{
		return true;
	}
}


function insertPage($page_name, $page_contents){

	global $con;

	$query = $con->prepare("INSERT INTO site_pages(page_name, page_contents) VALUES (:page_name,:page_contents)");
	$query->bindParam(':page_name', $page_name);
	$query->bindParam(':page_contents', $page_contents);
	
	return $query->execute();
}


function updatePageContents($page_name, $page_contents){

	global $con;

	$query = $con->prepare("UPDATE site_pages SET page_contents = :page_contents WHERE page_name LIKE :page_name");
	$query->bindParam(':page_name', $page_name);
	$query->bindParam(':page_contents', $page_contents);
	
	return $query->execute();
}
  // ----------------------------------------------------------------------//
 //                        Visitors Minitor Functions 					  //
// ----------------------------------------------------------------------//


function getTodaysVisitors(){

	global $con;

	$query = $con->prepare("SELECT * FROM visitors_counter WHERE DATE(time_and_date) = CURRENT_DATE");
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return 0;
	}
	else{
		return $row['total_visitors'];
	}

}
// 00000000000000000000000000000000000000000

function getYesterdaysVisitors(){

	global $con;

	$query = $con->prepare("SELECT * FROM visitors_counter WHERE DATE(time_and_date) = CURDATE() - 1");
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return 0;
	}
	else{
		return $row['total_visitors'];
	}
}
// 00000000000000000000000000000000000000000

function getThisMonthVisitors(){

	global $con;

	$query = $con->prepare("SELECT * FROM visitors_counter WHERE MONTH(time_and_date) = MONTH(CURRENT_DATE()) AND YEAR(time_and_date) = YEAR(CURRENT_DATE())");

	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return 0;
	}
	else{

		$count = 0;

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$count = $count + $row['total_visitors'];
		}

		return $count;
	}
}
// 00000000000000000000000000000000000000000

function getLastMonthVisitors(){

	global $con;

	$query = $con->prepare("SELECT * FROM visitors_counter WHERE YEAR(time_and_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(time_and_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)");

	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return 0;
	}
	else{

		$count = 0;

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$count = $count + $row['total_visitors'];
		}
		
		return $count;
	}
}
// 00000000000000000000000000000000000000000

function getThisYearVisitors(){

	global $con;

	$query = $con->prepare("SELECT * FROM visitors_counter WHERE YEAR(time_and_date) = YEAR(CURDATE())");

	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return 0;
	}
	else{

		$count = 0;

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$count = $count + $row['total_visitors'];
		}
		
		return $count;
	}
}
// 00000000000000000000000000000000000000000

function getLastYearVisitors(){

	global $con;

	$query = $con->prepare("SELECT * FROM visitors_counter WHERE YEAR(time_and_date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))");

	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC);

	if ($query->rowCount() == 0) {
		return 0;
	}
	else{

		$count = 0;

		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			$count = $count + $row['total_visitors'];
		}
		
		return $count;
	}
}
<?php 
	session_start();

	/**
	 * IDENTIFICATION
	 * This is a page refresh so a new session must be started 
	 * This sends you to the login 
	 */
	
	header('location: ./projecten.php');

	// if (!isset($_SESSION['sid']) || ($_COOKIE['PHPSESSID'] != $_SESSION['sid'])) {
	// 	header('location: ./login.php'); 
	// 	return; 
	// } else {
	// }

	/**
	 * VIEW
	 */
	
	//include('html_kop.inc.php');

	/**
	 * So if one is not send to ./login.php, the logout form will be visible:
	 */
?>





	<!-- // Functies
	
?> -->
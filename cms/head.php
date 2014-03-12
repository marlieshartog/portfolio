<?php 
	session_start();

	include('config.inc.php');
	include('database.class.php');

	$db = new Database_class(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	$db->opendb();

	require 'login.php';

?>
<!DOCTYPE html> <!-- zeg tegen je browser welk dialect HTML je spreekt -->
<html> <!-- Begin de pagina (XMLSN is niet meer nodig dankzij html5) -->
	<head>
		<link rel="stylesheet" href="style/css/style.css" />
		<title>Marlies d'r pro-CMS</title>
	</head>

	<body>
		<div class="wrapper">
			<a href="../">Terug naar de site</a><br/><br/><br/>
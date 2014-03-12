<?php 
	session_start();

	include('config.inc.php');
	include('database.class.php');

	$db = new Database_class(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	$db->opendb();

	require 'login.php';
	

?>

<?php

	session_start();

	include('config.inc.php');
	include('database.class.php');

	$db = new Database_class(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	$db->opendb();

	require 'login.php';

	if (isset($_POST['create_row'])) {
		$sql = "INSERT INTO texts (title) VALUES ('".$_POST['new_title']."')";
			$result = $db->querydb($sql); 
			$sql = "SELECT id FROM texts";
				$result = $db->querydb($sql);
			// var_dump($result); 
			// echo '<br/><br/>';
			$last_key = key(array_slice($result, -1, 1, TRUE));
			$last_id = $result[$last_key];  
			// var_dump($last_id); 
			// echo 'Succesfully submitted new text';
			// $new_id = 
			header('Location: textedit.php?id='.$last_id['id']);
	}
	

		$sql = "SELECT title, id FROM texts";
			$result = $db->querydb($sql);

		foreach ($result as $key => $value) {
			echo '<a href="textedit.php?id='.$value['id'].'">'.$value['id'].' </a>
				  <a href="textedit.php?id='.$value['id'].'">'.$value['title'].'</a><br/>';  
			}

		
		$newrow =  '<form name=new_row action="" method="POST">';
		$newrow .= '<input type="text" name="new_title" value="" />';
		$newrow .= '<input type="submit" name="create_row" value="Create Text" /></form>';

		echo $newrow;
	

			echo $form; 

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

<?php
	include 'footer.php';
	
	// '".$_POST['text']."'WHERE title='About me - personal (text)'"
	// 
// 	INSERT INTO texts( title ) 
// VALUES (
//  'projects'
// )

?>
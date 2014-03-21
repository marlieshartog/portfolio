<?php

	include 'head.php';


	if (isset($_POST['create_row'])) {
		

		$sql = "INSERT INTO texts (name) VALUES ('".$_POST['new_text']."')";
		$result = $db->querydb($sql); 
		$sql = "SELECT id FROM texts";
		$result = $db->querydb($sql);

		

		$last_key = key(array_slice($result, -1, 1, TRUE)); //source: http://stackoverflow.com/a/7478419
		$last_id = $result[$last_key];  
		
		if (!empty($_POST['new_title'])) {

			$sql = "INSERT INTO titles (title_NL_nl, title_id) VALUES ('".$_POST['new_title']."', '". $last_id['id'] . "')"; 

			$result2 = $db->querydb($sql);
		}
		# @TODO in session boodschap meegeven: echo 'Succesfully submitted new text';
		header('Location: textedit.php?id='.$last_id['id']); // source: http://forums.phpfreaks.com/topic/274717-data-gets-repostedsubmitted-with-refresh-disable/
	}

	if (isset($_POST['create_project'])) {
		$sql 		= "	INSERT INTO projects (title_NL_nl) 
						VALUES ('".$_POST['new_project']."')
					  ";
		$result 	= $db->querydb($sql); 
		$sql 		= "SELECT id FROM projects";
		$result 	= $db->querydb($sql);
		
		$last_key 	= key(array_slice($result, -1, 1, TRUE));
		$last_id 	= $result[$last_key];  

		# @TODO in session boodschap meegeven: echo 'Succesfully submitted new project';
		header('Location: projectedit.php?id='.$last_id['id']); 
	}
	

	$sql = "SELECT name, id FROM texts";
	$result = $db->querydb($sql);
	echo '<h1>Texts</h1>';
	foreach ($result as $key => $value) {
		echo '<a href="textedit.php?id='.$value['id'].'">'.$value['id']. ' ' .$value['name'].'</a><br/>';  
	}
	
	/**
	 * Nieuwe tekst met/zonder titel maken
	 */
	
	$newrow =  '<form name=new_row action="" method="POST">';
	$newrow .= '<input type="text" name="new_text" value="" />';
	$newrow .= '<input type="text" name="new_title" placeholder="optional" value ="" />';
	$newrow .= '<input type="submit" name="create_row" value="Create Text" /></form>';
	echo $newrow;

	$sql = "SELECT title_NL_nl, id FROM projects";
	$result = $db->querydb($sql); 
	echo '<h1>Projects</h1>';
	foreach ($result as $key => $value) {
		echo '<a href="projectedit.php?id='.$value['id'].'">'.$value['id']. ' ' .$value['title_NL_nl'].'</a><br/>';
	}
	$newproject =  '<form name="new_project" action="" method="POST">';
	$newproject .= '<input type="text" name="new_project" value="" />';
	$newproject .= '<input type="submit" name="create_project" value="Create Project" /></form><br/>';
	echo $newproject; 

	echo $form; 

	include 'html_head.inc.html';
	include 'footer.php';
	
	// '".$_POST['text']."'WHERE title='About me - personal (text)'"
	// 
// 	INSERT INTO texts( title ) 
// VALUES (
//  'projects'
// )

?>
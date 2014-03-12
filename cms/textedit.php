<?php 

		include 'head.php';

		

		// EDIT THE ENGLISH TEXT
	if (isset($_POST['edit_title'])) {
		$sql = "UPDATE texts SET title = '".$_POST['title']."'WHERE id='".$_GET['id']."'"; 
				$db->querydb($sql);

		$sql = "SELECT title FROM texts WHERE id='".$_GET['id']."'";
			$result = $db->querydb($sql);
		}
	
	// EDIT THE DUTCH TEXT
	if (isset($_POST['edit'])) {
		$sql = "UPDATE texts SET NL_nl = '".$_POST['text']."' WHERE id='".$_GET['id']."'"; 
				$db->querydb($sql);

		$sql = "SELECT NL_nl FROM texts WHERE id='".$_GET['id']."'";
			$result = $db->querydb($sql);
		}

	// find the right text 
	$sql = "SELECT NL_nl FROM texts WHERE id='".$_GET['id']."'";
			$result = $db->querydb($sql);

	function show_text(&$result = array()) {
		$return = '<h1>Edit text</h1>';
		$return .= '<form name="edit" action="" method="POST">';

		$return .='
			<textarea name="text">'.$result[0]['NL_nl'].'</textarea><br/>
			';
		$return .='
			<input type="submit" name="edit" value="Submit"/>';
		$return .= '</form>';
		return $return;

	}

// find the right title 
	$sql = "SELECT title FROM texts WHERE id='".$_GET['id']."'";
			$result2 = $db->querydb($sql);

	function show_title(&$result2 = array()) {
		$return = '<h1>Edit title</h1>';
		$return .= '<form name="edit_title" action="" method="POST">';

		$return .='
			<textarea name="title">'.$result2[0]['title'].'</textarea><br/>
			';
		$return .='
			<input type="submit" name="edit_title" value="Submit"/>';
		$return .= '</form>';
		return $return;
	}

	echo show_title($result2);
	echo show_text($result);

	echo '<a href="cmshome.php">Terug naar alle projecten</a>'; 
		
?>
<?php 

	include 'head.php';

	# EDIT THE TITLE
	if (isset($_POST['edit_title'])) {
		$sql = "UPDATE texts SET title = '".$_POST['title']."'WHERE id='".$_GET['id']."'"; 
				$db->querydb($sql);

		$sql = "SELECT title FROM texts WHERE id='".$_GET['id']."'";
			$result = $db->querydb($sql);
		}
	
	# EDIT THE DUTCH TEXT
	if (isset($_POST['edit'])) {
		$sql = "UPDATE texts SET NL_nl = '".$_POST['text_NL_nl']."' WHERE id='".$_GET['id']."'"; 
				$db->querydb($sql);		
		$sql = "UPDATE texts SET EN_en = '".$_POST['text_EN_en']."' WHERE id='".$_GET['id']."'"; 
				$db->querydb($sql);

		$sql = "SELECT id, NL_nl, EN_en FROM texts WHERE id='".$_GET['id']."'";
			$result = $db->querydb($sql);
		}

	function show_text($result) {
		$field = '<h1 Edit texts</h1>';
		$field .= '<form name="edit_texts" action="" method="POST">';
		# show text in all languages
		foreach ($result as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$field .= '<h2>Edit '.$key2 .'</h2>';
				$field .= '<textarea name="text_'.$key2.'">'.$result[0][$key2].'</textarea><br/>';
			} 
		}

		$field .= '<input type="submit" name="edit" value="Submit all"/>';
		$field .= '</form>';
		return $field;

	}

	function show_title($result2 = array()) {
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

	// find the right title 
	$sql = "SELECT title FROM texts WHERE id='".$_GET['id']."'";
			$result2 = $db->querydb($sql);
	# execute show_title
	echo show_title($result2);


	# find the right texts
	$sql = "SELECT NL_nl, EN_en FROM texts WHERE id='".$_GET['id']."'";
			$result = $db->querydb($sql);

	# execute show_text
	echo show_text($result);





	echo '<a href="cmshome.php">Terug naar alle projecten</a>'; 
		
?>
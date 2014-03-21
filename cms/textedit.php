<?php 
	include 'head.php';

	# find the name of paragraph
	# 
	$sql = "SELECT name 
			FROM texts 
			WHERE id = :id";

	$parameters = array(
					':id'			=> $_GET['id']
					);

	$result = $db->querydb($sql, $parameters);

	echo '<h1>'.$result[0]['name'].'</h1>';

	function show_title($result2 = array()) {
		// echo "<pre>";
		// print_r($result2);
		// echo "</pre>";
		$return = '';
		foreach ($result2[0] as $key => $value) {
			
			$return .=  '<h1>Edit title '.$key.'</h1>';
			$return .= '<form name="edit_title" action="" method="POST">';
	
			$return .= '<textarea name="'.$key.'">'.$value.'</textarea><br/>';			
		}

		$return .= '<input type="submit" name="edit_title" value="Submit"/>';
		$return .= '</form>';

		return $return;
	}

	function show_text($result) {

		$field = '<h1>Edit texts</h1>';
		$field .= '<form name="edit_texts" action="" method="POST">';

		# show text in all languages
		foreach ($result as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$field .= 	'<h2>Edit '.$key2 .'</h2>';
				$field .= 	'<textarea style="width:400px; height:200px;" name="text_'.$key2.'">'
							.$result[0][$key2].
							'</textarea><br/>';
			} 
		}

		$field .= '<input type="submit" name="edit" value="Submit all"/>';
		$field .= '</form>';
		return $field;

	}

	


	# EDIT THE TITLE
	if (isset($_POST['edit_title'])) {

		$sql = "UPDATE titles 
				SET title_NL_nl = :title_NL_nl
				WHERE title_id  = :id"; 

		$parameters = array(
						':title_NL_nl'		=> $_POST['title_NL_nl'],
						':id'				=> $_GET['id']
						);

		$db->querydb($sql, $parameters);

		$sql = "UPDATE titles 
				SET title_EN_en = :title_EN_en
				WHERE title_id  = :id"; 

		$parameters = array(
						':title_EN_en'		=> $_POST['title_EN_en'],
						':id'				=> $_GET['id']
						);

		$db->querydb($sql, $parameters);

	}
	
	# EDIT THE TEXT
	if (isset($_POST['edit'])) {

		$sql = "UPDATE texts 
				SET NL_nl = :text_NL_nl 
				WHERE id = :id"; 

		$parameters = array(
						':text_NL_nl'	=> $_POST['text_NL_nl'],
						':id'			=> $_GET['id']
			);

		$db->querydb($sql, $parameters);	

		$sql = "UPDATE texts 
				SET EN_en = :text_EN_en 
				WHERE id= :id"; 

		$parameters = array(
						':text_EN_en'	=> $_POST['text_EN_en'],
						':id'			=> $_GET['id']
						);

		$db->querydb($sql, $parameters);

		$sql = "UPDATE titles 
				SET title_NL_nl = :title_NL_nl
				WHERE title_id  = :id"; 

		$parameters = array(
						':title_NL_nl'		=> $_POST['title_NL_nl'],
						':id'				=> $_GET['id']
						);

		$db->querydb($sql, $parameters);

		$sql = "UPDATE titles 
				SET title_EN_en = :title_EN_en
				WHERE title_id  = :id"; 

		$parameters = array(
						':title_EN_en'		=> $_POST['title_EN_en'],
						':id'				=> $_GET['id']
						);

		$db->querydb($sql, $parameters);

	}


	// find the right title, if there is one
	
	$sql = "SELECT title_NL_nl, title_EN_en 
			FROM titles 
			INNER JOIN texts ON titles.title_id = texts.id
			WHERE texts.id = :id";

	$parameters = array(
					':id'			=> $_GET['id']
					);

	$result2 = $db->querydb($sql, $parameters);

	# execute show_title
	
	if (!empty($result2)) {
		echo show_title($result2);
	}
	

	# find the right texts
	$sql = "SELECT NL_nl, EN_en 
			FROM texts 
			WHERE id = :id";

	$parameters = array(
					':id'			=> $_GET['id']
					);

	$result = $db->querydb($sql, $parameters);

	# execute show_text
	echo show_text($result);
	echo '<a href="cmshome.php">Terug naar alle projecten</a>'; 
		
?>
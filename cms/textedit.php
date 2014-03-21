<?php 
	include 'head.php';

	# find the name of paragraph
	
	$sql = "SELECT name 
			FROM texts 
			WHERE id = :id";

	$parameters = array(
					':id'			=> $_GET['id']
					);

	$result = $db->querydb($sql, $parameters);

	echo '<h1>'.$result[0]['name'].'</h1>';


	function show_text($result, $result2 = array()) {

		$form = '';
		$form .= '<form name="edit_all" action="" method="POST">';

		if (!empty($result2)) {
			//$form = '';
			foreach ($result2[0] as $key => $value) {
			
				$form .= '<label for="'.$key.'">'.$key.':</label>';
				$form .= '<form name="edit_title" action="" method="POST">';
				$form .= '<textarea id="'.$key.'" name="'.$key.'">'.$value.'</textarea><br/>';			
			}
		}

		# show text in all languages
		foreach ($result as $key => $value) {
			foreach ($value as $key2 => $value2) {
				$form .= 	'<label for="text_'.$key2.'">text_'.$key2.':</label>';
				$form .= 	'<textarea style="width:400px; height:200px;" id="text_'.$key2.'" name="text_'.$key2.'">'
							.$result[0][$key2].'</textarea><br/>';
			} 
		}

		$form .= '<input type="submit" name="edit_all" value="Submit all"/>';
		$form .= '</form>';
		return $form;

	}

	
	# EDIT THE TEXT
	if (isset($_POST['edit_all'])) {

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
	

	# find the right title, if there is one
	
	$sql = "SELECT title_NL_nl, title_EN_en 
			FROM titles 
			INNER JOIN texts ON titles.title_id = texts.id
			WHERE texts.id = :id";

	$parameters = array(
					':id'			=> $_GET['id']
					);

	$result2 = $db->querydb($sql, $parameters);

	// echo "<pre>";
	// print_r($result2);
	// echo "</pre>";
	
	# find the right texts
	$sql = "SELECT NL_nl, EN_en 
			FROM texts 
			WHERE id = :id";

	$parameters = array(
					':id'			=> $_GET['id']
					);

	$result = $db->querydb($sql, $parameters);

	# execute view
	echo show_text($result, $result2);


	echo '<a href="cmshome.php">Terug naar alle projecten</a>'; 
		
?>
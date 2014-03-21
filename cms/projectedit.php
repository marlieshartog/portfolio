<?php 

	include 'head.php';

	function show_text($result) {
		$field = '<h1>Edit project</h1>';
		$field .= '<form name="edit_projects" action="" method="POST">';
		
		# show title and text in all languages
		foreach ($result as $key => $value) {

			foreach ($value as $key2 => $value2) {
				$field .= '<h2>Edit '.$key2 .'</h2>';
				$field .= '<textarea  style="width:400px; height:200px;" name="'.$key2.'">'.$result[0][$key2].'</textarea><br/>';
			} 
		}

		$field .= '<input type="submit" name="edit" value="Submit all"/>';
		$field .= '</form>';
		return $field;
	}

	
	# EDIT THE TEXT
	if (isset($_POST['edit'])) {

		$sql = "UPDATE projects 
				SET 
					title_NL_nl = :title_NL_nl,
					title_EN_en = :title_EN_en,
					text_NL_nl 	= :text_NL_nl,
					text_EN_en 	= :text_EN_en,
					demo_url	= :demo_url,
					source_url	= :source_url 
				WHERE id = :id";

		$parameters = array(
						':id' 			=> $_GET['id'],
						':title_NL_nl' 	=> $_POST['title_NL_nl'],
						':title_EN_en' 	=> $_POST['title_EN_en'],
						':text_NL_nl' 	=> $_POST['text_NL_nl'],
						':text_EN_en' 	=> $_POST['text_EN_en'],
						':demo_url'		=> $_POST['demo_url'],
						':source_url'	=> $_POST['source_url']);

		$db->querydb($sql, $parameters);

		$sql = "SELECT id, title_NL_nl, title_EN_en, text_NL_nl, text_EN_en, demo_url, source_url 
				FROM texts 
				WHERE id = :id";

		$parameters = array(
						':id'			=> $_GET['id']
						);

		$result = $db->querydb($sql, $parameters);
	}

	# find the right texts to show
	$sql 	= "	SELECT title_NL_nl, title_EN_en, text_NL_nl, text_EN_en, demo_url, source_url 
				FROM projects 
				WHERE id = :id";

	$parameters = array(
					':id'			=> $_GET['id']
					);

	$result = $db->querydb($sql, $parameters);






	// VIEW
	# execute show_text
	echo show_text($result);
	echo '<a href="cmshome.php">Terug naar alle projecten</a>'; 
		
?>
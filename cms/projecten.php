<?php
	include 'head.php'; 

	if (isset($_POST['create_project'])) {
		$sql = "INSERT INTO projects (title) VALUES ('".$_POST['new_project']."')";
			$result = $db->querydb($sql); 
	}

	$sql = "SELECT title, id FROM projects";
			$result = $db->querydb($sql); 

		foreach ($result as $key => $value) {
			echo '<a href="projectedit.php?id='.$value['id'].'">'.$value['id'].' </a>
				  <a href="projectedit.php?id='.$value['id'].'">'.$value['title'].'</a><br/>';
		}

		$newproject =  '<form name=new_project action="" method="POST">';
		$newproject .= '<input type="text" name="new_project" value="" />';
		$newproject .= '<input type="submit" name="create_project" value="Create Project" /></form><br/>';

		return $newproject; 
	
		echo show_projects($result);

?>
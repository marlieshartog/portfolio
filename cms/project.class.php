<?php
	
	$sql = "SELECT * 
			FROM projects 
			WHERE id = :id";

	$parameters = array(
					':id'			=> $_GET['id']
					);

	$result = $db->querydb($sql, $parameters);

		
	class Project {

		

	}

?>
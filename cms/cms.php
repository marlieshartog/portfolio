<?php
	include('config.inc.php')
	include('database.class.php'); 

	$db = new Database_class(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	$db->opendb();

	$sql = "SELECT NL_nl FROM texts WHERE title = 'test text 1'";
			$result = $db->querydb($sql);

	function form_in($result){
		$return = '<h1>Edit text</h1>';
		$return .= '<form name="edit" action="" method="POST">';

		$return .="
			<input type="'text'" name="'text'" value="$result" /><br/>
			";

		$return .= '</form>';
		return $return;
	}

	echo form_in();

?>
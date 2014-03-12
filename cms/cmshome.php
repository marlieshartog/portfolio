<?php
	//ToDo elke text uit de database halen
		//maak een link naar textedit.php ahref = textedit.php?id=$id van de tekst in de loop
		//kijk of er een get variabele met id is meegegeven
		//dan haal je tekst op in NL en ENG en zet je in text area 
		//submit = post 
		//
	
	include 'head.php';

	if (isset($_POST['create_row'])) {
		$sql = "INSERT INTO texts (title) VALUES ('".$_POST['new_title']."')";
		$result = $db->querydb($sql); 
	}

	$sql = "SELECT title, id FROM texts";
			$result = $db->querydb($sql);

	foreach ($result as $key => $value) {
		echo '<a href=
			"textedit.php?id='.$value['id'].'">'.$value['title'].'</a><br/>';  
		}

	
	$newrow = '<form name=new_row action="" method="POST">';
	$newrow .= '<input type="text" name="new_title" value="" />';
	$newrow .= '<input type="submit" name="create_row" value="Create Row" />';

	echo $newrow;

	include 'footer.php';
	
	// '".$_POST['text']."'WHERE title='About me - personal (text)'"
	// 
// 	INSERT INTO texts( title ) 
// VALUES (
//  'projects'
// )

?>
<?php
	/**
	 * CONTROLLER
	 */
	/**
	 * Start by stating there is no session yet
	 * There is no form to show
	 */
	
	$session = false; 
	$form 	= ''; 


	/**
	 * Primary concern: if signout was performed, destroy the session
	 */
	
	if (isset($_POST['signout'])) {
		destroy_session();
	}

	/**
	 * Determine which form needs to be showed
	 */
	
	if (isset($_SESSION['sid']) && $_COOKIE['PHPSESSID'] == $_SESSION['sid']) {
		// header('location: ./index.php'); 
		$form = form_out();
	} else {
		if (isset($_POST['in'])) {
			$check = signin($errors); 
			if ($check === false) {
				$form = form_in($errors); 
			} else {
				create_session($check);
				$session = true; 
				$form = form_out();
				// header('location: ./index.php'); 
			}
		} else{//if (isset($_GET['cms'])) {
				$form = form_in();
		}  
	}

	// include('html_kop.inc.php');
	echo $form; 

	if (isset($_SESSION['sid']) && $_COOKIE['PHPSESSID'] == $_SESSION['sid']) {
	} else {
		die();
	}

// @todo
	/**
	 * [signin description]
	 * @return [type]        [description]
	 */
	function signin(&$back) {
		global $db;
		$ok = true;

		if ($_POST['username'] == '') {
			$back['error_username'] = 'Vul gebruikersnaam in.';
			$ok &= false;
		}
		if ($_POST['password'] == '') {
			$back['error_pass'] = 'Vul wachtwoord in.';
			$ok &= false;
		}
		if ($ok) {
			//check database for correct match
			// get NAME from database
			$sql 		= "SELECT id, username FROM user WHERE username = '".$_POST['username']."' && password = '".$db->versleutel($_POST['password'])."'";
			$records 	= $db->querydb($sql);
			
			if (count($records) > 0) {
			// session-id in db stoppen
				$sql = "UPDATE user SET sid = '".session_id()."'WHERE id='".$records[0]['id']."'"; 
				$db->querydb($sql);
				return $records[0]['username']; 
			} else {
				$back['error_username'] = 'Gegevens niet correct.';
				return false; 
			}
		} else {
			return false;
		}
	}
	
	function create_session($name) {
		$_SESSION['sid'] 	= session_id(); 
		$_SESSION['name'] 	= $name; 
	}

	function destroy_session() {
		setcookie('PHPSESSID', '', time()-3600, './'); 
		session_destroy();
		session_unset();
		// fourth argument of cookie is the domain: only set cookie when it's my domain ./
		header ('location: ./index.php');
	}

	// function form_inup(){
	// 	return ' 
	// 	<h1>Sign In</h1>
	// 	<a href="'.$_SERVER["SCRIPT_NAME"].'?signin">Sign In</a> of 
	// 	'; 
	// }

	function form_in($gegevens = array()){
		$to_return = '<h1>Sign In</h1>';
		$to_return .= '<form name="signin" action="" method="POST">';
		
		if(isset($gegevens['error_username'])){
			$to_return .= $gegevens['error_username'].'<br/>';
		}

		// if(isset($_POST['username'])){
		// 	$prefill = $_POST['username'];
		// }else{
		// 	$prefill = '';
		// }

		$to_return .='
			Username:
			<input type="text" name="username" value="" /><br/>
			';

		if(isset($gegevens['error_pass'])){
			$to_return .=$gegevens['error_pass'].'<br/>';
		}
		$to_return .='
			Password:
			<input type="password" name="password" value="" /><br/>
			<input type="submit" name="in" value="Sign In" /><br/>
			';
		$to_return .= '</form>';
		return $to_return;
	}

	function form_out(){
		return '
		<div>Ingelogd als '.$_SESSION['name'].'</div>
			<div id="afmeldformulier">
				<form name="signup" method="POST">
				<input type="submit" name="signout" value="Sign out now" />
				</form>
			</div>';

	}
?>
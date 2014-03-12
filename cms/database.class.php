<?php
	class Database_class{
		var $dbhost;
		var $dbname;
		var $dbuser;
		var $dbpass;
		var $dblink;

		function __construct($h, $n, $u, $p) {
			//echo 'Database_class -> construct<br/>';
			$this->dbhost = $h;
			$this->dbname = $n;
			$this->dbuser = $u; 
			$this->dbpass = $p; 
		}

		function opendb() {
			//echo 'Database_class -> opendb<br/>';
			try { 
			  $this->dblink = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);  
			}  
			catch(PDOException $e) {  
				// In case there is a problem with the database
			    echo 'ERROR connecting PDO: <br/>'. $e->getMessage();  
			}
		}
		
		function sluitdb($hoi) {
			//echo 'Database_class -> sluitdb<br/>';
			$this->dblink = NULL; 
		}

		function querydb($sql, $parameters = array()) {


			//echo 'Database_class -> querydb<br/>'; 
			try{
				// Je sql query
				$query = $this->dblink->prepare($sql);
				
				// De sql query uitvoeren
				$query->execute($parameters); 
				
				// Resultaat opvangen in variabele
				$result = $query->fetchAll(PDO::FETCH_ASSOC);
				
				return $result;
			} 
			catch(PDOException $e)
			{
				// Problem met query afvangen
				die('Error executing SQL query: <br/>' . $e->getMessage());
			}
		}

		function aantaldb($sql) {
			//echo 'Database_class -> aantaldb<br/>'; 
			try{
				// Je sql query
				$query = $this->dblink->prepare($sql);
				
				// De sql query uitvoeren
				$query->execute(); 
				
				// Resultaat opvangen in variabele
				return $query->rowCount(); 
			} 
			catch(PDOException $e)
			{
				// Problem met query afvangen
				die('Error executing SQL query: <br/>' . $e->getMessage());
			}
		}

		function schonestring($string, $html=false) {
			//echo 'Database_class -> schonestring<br/>';
			$string = trim($string); 
			if (!$html) {
				$string = strip_tags($string);
			}
			return $string; 
		}

		function maaksqldate($tijdstamp) {
			//echo 'Database_class -> maaksqldate<br/>';
			return date('Y-m-d H:i:s', $tijdstamp); 
		}

		function versleutel($pass) {
			//echo 'Database_class -> versleutel<br/>';
			return sha1($pass);
		}
	}
?>
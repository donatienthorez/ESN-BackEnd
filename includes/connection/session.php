<?php
	session_start();
	
	ini_set('display_errors', 1);
	
	// Annule les magic quotes si activées
	if(get_magic_quotes_gpc()){
		function stripslashes_deep($value) {
			return (is_array($value)) ? array_map('stripslashes_deep', $value) : stripslashes($value);
		}
		$_GET    = array_map('stripslashes_deep', $_GET);
		$_POST   = array_map('stripslashes_deep', $_POST);
		$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
	}	

	include 'includes/database/Database.php';
	include 'includes/connection/CAS.php';
	
	$db = new Database("includes/database/config.xml");
	
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		
		
		$stmt = $db->connexion->prepare("SELECT * from user where username=:username and password=:password ");
        $stmt->bindParam(':username',$_POST['username']);
        $stmt->bindParam(':password',$_POST['password']);
        $stmt->execute();
		
		
			$data = $stmt->fetch(PDO::FETCH_OBJ);
		
			$_SESSION['username'] = $data->username;
			$_SESSION['code_section'] = $data->code_section;
			
		
		
		
		
	}
	
?>
	

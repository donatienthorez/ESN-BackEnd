<?php
	session_start();
	
	
	include 'includes/database/Database.php';
	
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
	
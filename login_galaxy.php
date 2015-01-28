<?php


	include 'includes/connection/CAS.php';
ini_set('display_errors', 1);

// Enable debugging
phpCAS::setDebug();
// Initialize phpCAS

phpCAS::client(CAS_VERSION_2_0, "galaxy.esn.org", 443, "/cas");

phpCAS::setNoCasServerValidation();
// force CAS authentication
phpCAS::forceAuthentication();
// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().
// logout if desired

/*if (isset($_REQUEST['logout'])) {
	phpCAS::logout();
	echo '<meta http-equiv="refresh" content="2; url=index.php?page_id=6">';
}*/
$user = phpCAS::getUser();


if (isset($user)){

	$_SESSION['username'] = phpCAS::getUser();
	$_SESSION['cas'] = true;
	$attributes = phpCAS::getAttributes();
	$_SESSION['code_section']=$attributes['sc'];
	header('Location: /survivalGuide/index.php');  
}

?>

Connecting ...

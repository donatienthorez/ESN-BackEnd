<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

// Annule les magic quotes si activées
if(get_magic_quotes_gpc()){
	function stripslashes_deep($value) {
		return (is_array($value)) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	}
	$_GET    = array_map('stripslashes_deep', $_GET);
	$_POST   = array_map('stripslashes_deep', $_POST);
	$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}


include '../database/Database.php';
include '../entities/Category.php';
include '../model/CategoryModel.php';

if(isset($_SESSION['username']) && isset($_SESSION['code_section']))
{
	if(isset($_GET['content']) && $_GET['content']!="" && isset($_GET['name']) && isset($_GET['parent']) && isset($_GET['position']))
	{
		$db = new Database("../database/config.xml");
		$cs = new CategoryModel($db);
		$cs->addCategory($_GET['parent'],new Category(null,$_GET['name'],$_SESSION['code_section'],$_GET['content'],$_GET['position']),$_GET['position']);
		
		
	}
}

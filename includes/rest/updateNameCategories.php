<?php
session_start();

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);

include '../database/Database.php';
include '../entities/Category.php';
include '../model/CategoryModel.php';

// Annule les magic quotes si activées
if(get_magic_quotes_gpc()){
	function stripslashes_deep($value) {
		return (is_array($value)) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	}
	$_GET    = array_map('stripslashes_deep', $_GET);
	$_POST   = array_map('stripslashes_deep', $_POST);
	$_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}

// TODO control that this user can modify this category

if(isset($_SESSION['username']) && isset($_SESSION['code_section']))
{	
	if(isset($_GET['name']) && $_GET['name']!="" && isset($_GET['id']))
	{
		$db = new Database("../database/config.xml");
		$cs = new CategoryModel($db);
		
		$cs->updateNameCategories($_GET['id'],utf8_decode($_GET['name']),$_SESSION['code_section']);
		
	}
}

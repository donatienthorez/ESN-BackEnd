<?php
session_start();

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);

include '../database/Database.php';
include '../entities/Category.php';
include '../model/CategoryModel.php';

// TODO control that this user can modify this category

if(isset($_SESSION['username']) && isset($_SESSION['code_section']))
{	
	if(isset($_GET['id']) && isset($_GET['position']) )
	{
		$db = new Database("../database/config.xml");
		$cs = new CategoryModel($db);
		
		$cs->updatePositionCategories($_GET['id'],utf8_decode($_GET['position']),$_SESSION['code_section']);
		echo "test";
		
	}
}

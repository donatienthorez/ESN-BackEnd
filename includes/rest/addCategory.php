<?php
session_start();

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);

include '../database/Database.php';
include '../entities/Category.php';
include '../model/CategoryModel.php';


echo "test";

if(isset($_SESSION['username']) && isset($_SESSION['code_section']))
{
	if(isset($_GET['content']) && $_GET['content']!="" && isset($_GET['name']) && isset($_GET['parent']) && isset($_GET['position']))
	{
		$db = new Database("../database/config.xml");
		$cs = new CategoryModel($db);
		$cs->addCategory($_GET['parent'],new Category(null,$_GET['name'],$_SESSION['code_section'],$_GET['content'],$_GET['position']),$_GET['position']);
		
		
	}
}

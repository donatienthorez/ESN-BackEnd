<?php
session_start();

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);

include '../database/Database.php';
include '../entities/Category.php';
include '../model/CategoryModel.php';

if(isset($_SESSION['username']) && isset($_SESSION['code_section']))
{
	if(isset($_GET['id']) && $_GET['id']!="")
	{
	$db = new Database("../database/config.xml");
	$cs = new CategoryModel($db);

	$array = $cs->deleteCategory($_GET['id'],$_SESSION['code_section']);
	}
}
else
{
	echo "Vous n'êtes pas authentifié";
}

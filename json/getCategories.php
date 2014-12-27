<?php

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);

include '../includes/database/Database.php';
include '../includes/entities/Category.php';
include '../includes/model/CategoryModel.php';


if(isset($_GET['section']))
{
	$db = new Database("../includes/database/config.xml");
	$cs = new CategoryModel($db);
	$array = $cs->getCategories($_GET['section']);
	$json = json_encode($array);
	echo $json;
}

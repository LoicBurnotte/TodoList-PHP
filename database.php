<?php 
$start = time();
$connection = null;

function getConnection(&$connection){
	if($connection !== null){
		return $connection;
	}
	$connection = new PDO(
		'mysql:host=localhost;dbname=todo;charset=utf8', //connectionString
		'root', //username
		null //password
	);
	//options indispensables
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//affichage amélioré dans var_dump 
	$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	return $connection; 
}
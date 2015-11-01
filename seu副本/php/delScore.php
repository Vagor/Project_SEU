<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
/*
	$_POST["id"] = 1;
	$_POST["name"] = "高等数学";
*/
	
	$back = deleteScore($_POST["id"],$_POST["name"]);

	$data = array(
			"success" => $back
		);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
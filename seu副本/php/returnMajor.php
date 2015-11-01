<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
	$college = $_POST["college"];
	$data = returnMajor($college);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
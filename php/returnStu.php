<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();

	$college = $_POST["college"];
	$major = $_POST["major"];
	$year = $_POST["year"];	
	$class = $_POST["class"];


/*	$college = "电信学院";
	$major = "电信";
	$year = 2013  ;	
	$class = 1;
*/

	$data = returnStu($college,$major,$year,$class);

	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
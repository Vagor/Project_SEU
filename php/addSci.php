<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();

	$uid = $_SESSION["uid"];
	$tid = $_SESSION["tid"];
	$name = $_POST["name"];
	$time = $_POST["time"];
	$result = $_POST["result"];
	$score = $_POST["grade"];
	$type = $_POST["kind"];
/*
	
	$uid = 1;
	$tid = 1;
	$name = "test2";
	$time = "2015-8-6";
	$result = "test2";
	$score = 77;
	$type = 1;
	$semester = 1;
*/	
	$back = insertSciElement($uid,$tid,$name,$time,$result,$score,$type);
	$data = array(
			"success" => $back
		);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
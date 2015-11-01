<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
/*
	$id = 4;
	$tid = 1;
	$time = "2015-8-5";
	$type = 1;
	$score = 78;
	$location = "xy";
	$content = "233";
*/

	$id = $_POST["id"];
	$uid = $_SESSION["uid"];
	$tid = $_SESSION["tid"];
	$time = $_POST["date"];
	$type = $_POST["kind"];
	$score = $_POST["grade"];
	$location = $_POST["place"];
	$content = $_POST["content"];
	
	$res = updateSocialElement($id,$uid,$tid,$time,$type,$score,$location,$content);
	$data = array("success" => $res);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
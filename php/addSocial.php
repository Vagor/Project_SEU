<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();

	$uid = $_SESSION["uid"];
	$tid = $_SESSION["tid"];
	$time = $_POST["date"];
	$location = $_POST["place"];
	$score = $_POST["grade"];
	$type = $_POST["kind"];
	$content = $_POST["content"];
	

	$back = insertSocialElement($uid,$tid,$time,$location,$content,$score,$type);
	$data = array(
			"success" => $back
		);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
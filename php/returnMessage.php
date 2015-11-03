<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
	$uid = $_SESSION["uid"];
	$data = returnMessage($uid);
	removeMessage($uid);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
	
?>
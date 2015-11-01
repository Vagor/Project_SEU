<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
	echo $_POST["id"];
	$data = onloadSocial($_POST["id"]);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
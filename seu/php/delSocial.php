<?php
	session_start();
	$uid = $_SESSION["uid"];
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
/*
$id = 4;
*/
	$id = $_POST["id"];
	$res = deleteScoialElement($id);
	$data = array("success" => $res);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
<?php
	session_start();
	$uid = $_SESSION["uid"];
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
	$res = updateElement($uid,$_POST["name"],$_POST["college"],$_POST["nation"],$_POST["birthday"],$_POST["placeOfOrigin"],$_POST["nationality"],$_POST["stuid"],$_POST["major"],$_POST["gender"],$_POST["bloodType"],$_POST["religion"]);
	$data = array("success" => $res);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
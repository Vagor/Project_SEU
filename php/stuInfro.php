﻿<?php
	session_start();
	$uid = $_SESSION["uid"];

	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
	$data = getElement($uid);
	echo json_encode($data[0],JSON_UNESCAPED_UNICODE);
?>
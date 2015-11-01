<?php
	
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();
	$id = $_POST["id"];
	$data = returnSci($id);
	
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
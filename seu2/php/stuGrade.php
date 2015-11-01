<?php 
	session_start();
	$uid = $_SESSION["uid"];

	header("Content-Type:text/plain;charset=utf-8");
    include_once 'fun.inc.php';
    linkDB();
    $arr = getElement($uid);
    echo json_encode($arr[1],JSON_UNESCAPED_UNICODE);
?>
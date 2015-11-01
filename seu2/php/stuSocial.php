<?php 
	session_start();
	$uid = $_SESSION["uid"];

	header("Content-Type:text/plain;charset=utf-8");

    include_once 'fun.inc.php';
    linkDB();
    $arr = getSocialElement($uid);
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
?>
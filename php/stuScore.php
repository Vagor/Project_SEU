<?php 
	session_start();
	$uid = $_SESSION["uid"];

	header("Content-Type:text/plain;charset=utf-8");
	
    if(empty($_POST["term"]))
    {
        $term = 1;
        $kind = $_POST["kind"];
    }else{
        $term = $_POST["term"];
        $kind = $_POST["kind"];
    }

    include_once 'fun.inc.php';
    linkDB();
    $arr = getScore($uid,$term,$kind);
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
?>
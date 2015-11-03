<?php
	session_start();

	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();

	$uid = $_SESSION["uid"];
	$id = $_POST["id"];
	$name = $_POST["name"];
	$time = $_POST["time"];
	$result = $_POST["result"];
	$score = $_POST["grade"];
	$type = $_POST["kind"];
	//echo  $uid.$id.$name.$time.$result.$score.$type;
/*
	$uid = 1;
	$id = 6;
	$name = 789;
	$time = "2014-7-7";
	$result = "bad_ending";
	$score = 78;
	$type = 1;
	$semester = 1;
*/

	$res = updateSciElement($uid,$id,$name,$time,$result,$score,$type);
	$data = array("success" => $res);
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
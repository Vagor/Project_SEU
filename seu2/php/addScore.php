<?php
	session_start();
	header("Content-Type:text/plain;charset=utf-8");
	include_once 'fun.inc.php';
	linkDB();

	$uid = $_SESSION["uid"];
	$semester = $_POST["term"];
	$type_name = $_POST["kind"];
	$class_chinese_name = $_POST["course"];
	$score = $_POST["grade"];
/*
	$uid = 1;
	$semester = 1;
	$type_name = "基础课";
	$class_chinese_name = "C语言";
	$score = 82;

*/

	$back = addScore($uid,$semester,$type_name,$class_chinese_name,$score);

	$data = array(
			"success" => $back
		);


	echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>
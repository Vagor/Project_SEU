<?php 
	include 'fun.inc.php';
	linkDB();
	$term = $_POST["term"];
	$kind = $_POST["kind"];
	$sql = "SELECT class_name FROM class WHERE semester = $term AND class_type = $kind";
	$res = mysql_query($sql);
	$num = 0;
	while($arr = @mysql_fetch_assoc($res))
	{
		$data[$num++] = $arr["class_name"];
	}
	echo json_encode($data,JSON_UNESCAPED_UNICODE);
 ?>
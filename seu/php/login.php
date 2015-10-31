<?php 
	include_once 'fun.inc.php';
	linkDB();
	if(!empty($_POST["username"]) && !empty($_POST["passwd"]))
	{
		$username = check_input($_POST["username"]);
		$passwd = check_input($_POST["passwd"]);
	}else{
		echo "ERROR(1)!!";
		die();
	}

	$sql = "SELECT * FROM stu_login WHERE uid = ".$username." AND passwd = ".$passwd;
	$res = mysql_query($sql);
	if(mysql_num_rows($res))
	{
		$uid = @mysql_fetch_assoc($res)["id"];
		session_start();
		$_SESSION["uid"] = $uid;
		urlChange("../stu_index.php");
	}else{
		$sql2 = "SELECT * FROM teacher_login WHERE uid = ".$username." AND passwd = ".$passwd;
		$res2 = mysql_query($sql2);
		if(mysql_num_rows($res2))
		{
			$tid = @mysql_fetch_assoc($res)["id"];
			session_start();
			$_SESSION["tid"] = $uid;
			urlChange("../teach_index.php");
		}
	}
 ?>
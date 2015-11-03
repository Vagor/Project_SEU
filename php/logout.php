<?php
	session_start();
	@session_destroy();
	include 'fun.inc.php';
	urlChange("../login/login.php");
?>
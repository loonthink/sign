<?php

	header('Access-Control-Allow-Origin: *');
	
	include_once('./class_mysql/login.sql.progress.php');
	$user_name = $_REQUEST['name'];
	$user_pass = $_REQUEST['pass'];

	$login_conn = new login_pro($user_name, $user_pass);

	$login_res = $login_conn->selectUser();

	// var_dump($login_res);
	
?>
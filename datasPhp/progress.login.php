<?php

	header('Access-Control-Allow-Origin: http://localhost:8080');
	header("Access-Control-Allow-Credentials: true");

	session_start();

	include_once('./class_mysql/login.sql.progress.php');

	$user_name = $_REQUEST['name'];
	$user_pass = $_REQUEST['pass'];
	$user_type = $_REQUEST['type'];

	$login_conn = new login_pro($user_name, $user_pass);
	switch($user_type) {
		case 'login':
			$login_res = $login_conn->selectUser();
			break;
		case 'register':
			$login_res = $login_conn->insertUser();
		default:
			return '';
	};

	

	// var_dump($login_res);
	
?>
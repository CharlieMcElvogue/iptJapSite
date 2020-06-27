<?php
session_start();
require 'dbUtils.php';
$conn = getConn();

//check login
if(isset($_POST['login'])) {
	#include_once("dbConnect.php");
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	
	$username = stripslashes($username);
	$password = stripslashes($password);
	
	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);
	
	#$password = md5($password);
	$sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
	$query = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($query);
	$userId = $row['userId'];
	$db_password = $row['password'];
	$role = $row['role'];
	//check for correct login
	if($password == $db_password) {
		$_SESSION['username'] = $username;
		$_SESSION['userId'] = $userId;
		$_SESSION['role'] = $role;
		$_SESSION['sessionId'] = implode(mysqli_fetch_assoc(mysqli_query($conn, "SELECT sessionId FROM sessioninfo ORDER BY sessionId DESC LIMIT 1")));
		//post session info:
		$stmt = $conn->prepare("INSERT INTO sessioninfo (userId) VALUES (?)");
		if (!$stmt) die("DB PREPARE FAIL");
		if (!$stmt->bind_param("i", $userId)) die("BIND FAIL");
		if (!$stmt->execute()) die($conn->error);
		
		header("Location: index.php");
	} else {
		echo "you didn't enter the correct details :(";
	}
}









?>


<html>
<head>
	<title>Login</title>
	<link href="../stylesheet.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h1>Login</h1>
	<form action="login.php" method="post" enctype="multipart/form-data">
		<input placeholder="Username" name="username" type="text" autofocus>
		<input placeholder="Password" name="password" type="password">
		<input name="login" type="submit" value="Login">
	
</body>
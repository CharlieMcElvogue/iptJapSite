<?php
session_start();
require 'dbUtils.php';
$conn = getConn();

if(!isset($_SESSION['userId'])) {
	header("Location: login.php");
}
if($_SESSION['role'] == "student"){
	header("Location: index.php");
}
if(isset($_POST['userSubmit']))
	{
		
		$userId = $_POST['userId'];
		$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE userId = '$userId'");
		$row = mysqli_fetch_array($userQuery);
		$username = $row['username'];
		$reviewCount = $row['reviewCount'];
		
		$sessionCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM sessioninfo WHERE userId = '$userId'"))['COUNT(*)'];
		print_r($sessionCount);
		$avgQuiz = (mysqli_fetch_assoc(mysqli_query($conn, "SELECT AVG(quizScore) FROM sessioninfo WHERE userId = '$userId';"))['AVG(quizScore)'])*100;

	}
?>
<! DOCTYPE html>
<html>
<head>
<title>SPX Japanese</title>
<link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
</head>

<body>
	<header>
		<h1>Teacher's Page</h1>
	</header>
	
	<?php
	if ($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'teacher') {
		require("teacherNav.php");
	}
	else {
		require("studentNav.php");
	}
	?>
	<main>
	<h2 style="text-align: left">User Info</h2>
	<form action="teachers.php" method="post">
		<input placeholder="Enter UserID" name="userId" type="text" autofocus>
		<input name="userSubmit" type="submit" value="Enter">
	</form>
	<?php
	if(isset($_POST['userSubmit']))
	{
		echo "<p>Username: ",$username,"</p> <br>";
		echo "<p>Number of cards reviewed: ",$reviewCount,"</p> <br>";
		echo "<p>Number of times logged in: ",$sessionCount,"</p> <br>";
		echo "<p>Average quiz score: ",$avgQuiz,"%</p> <br>";
		
	}
	?>
	
	</main>
	
</body>
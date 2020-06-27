<?php
session_start();
require 'dbUtils.php';
$conn = getConn();

if(!isset($_SESSION['userId'])) {
	header("Location: login.php");
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
		<h1>Memory Aids</h1>
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
		<h2>Remembering the Meaning of Kana</h2>
		<p>A common method for remembering the pronunciation and meaning of both kanji and characters is to use certain associative memory aids to give a learner a point of reference when memorising large sets of characters. Some example memory aids are given below, but it is also useful to come up with your own. Whatever makes remembering more easy!
		</p>
		<br>
		<img src="../img/aMemory.png" style="width:50%";>
		<br>
		<img src="../img/iMemory.png" style="width:50%";>
		<br>
		<img src="../img/uMemory.png" style="width:50%";>
		<br>
		<img src="../img/eMemory.png" style="width:50%";>
		<br>
		<img src="../img/oMemory.jpg" style="width:50%";>
		<br>
	
	
	
	</main>
	
</body>
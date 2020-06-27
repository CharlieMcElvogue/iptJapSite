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
		<h1>Stroke Order Guide</h1>
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
		<h2> The Importance of Stroke Order </h2>
		<p>
		Unlike characters in the Roman alphabet used by many western languages, characters used in Japanese, whether they be Hirigana, Katakana or Kanji often require multiple pen strokes to write. The order in which these strokes are written are important as they can affect the dimensions and appearance of the character. Below are some examples for correct stroke order of Hirigana characters.
		</p>
		<br>
		<img src="../img/gif/Hiragana_a_stroke_order_animation.gif">
		<p>Correct stroke order for the "a" hirigana character.</p>
		<br>
		<img src="../img/gif/Hiragana_i_stroke_order_animation.gif">
		<p>Correct stroke order for the "i" hirigana character.</p>
		<br>
		<img src="../img/gif/Hiragana_u_stroke_order_animation.gif">
		<p>Correct stroke order for the "u" hirigana character.</p>
		<br>
		<img src="../img/gif/Hiragana_e_stroke_order_animation.gif">
		<p>Correct stroke order for the "e" hirigana character.</p>
		<br>
		<img src="../img/gif/Hiragana_o_stroke_order_animation.gif">
		<p>Correct stroke order for the "o" hirigana character.</p>

	
	
	
	
	
	</main>
	
</body>
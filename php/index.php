<?php
session_start();
require 'dbUtils.php';
$conn = getConn();

if(!isset($_SESSION['userId'])) {
	header("Location: login.php");
}
print_r($_SESSION);
?>
<! DOCTYPE html>
<html>
<head>
<title>SPX Japanese</title>
<link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
</head>

<body>
	<header>
		<h1>Learn to Read</h1>
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
	<h2>The Japanese Writing System</h2>
	<br>
	<p>
	The modern Japanese writing system uses a combination of logographic kanji, which are adopted Chinese characters, and syllabic kana. Kana itself consists of a pair of syllabaries: hiragana, used primarily for native or naturalised Japanese words and grammatical elements, and katakana, used primarily for foreign words and names, loanwords, onomatopoeia, scientific names, and sometimes for emphasis. Almost all written Japanese sentences contain a mixture of kanji and kana. Because of this mixture of scripts, in addition to a large inventory of kanji characters, the Japanese writing system is often considered to be one of the most complicated in use anywhere in the world.
	</p>
	
	
	</main>
	
</body>	
	
	
	
	
	
	
<?php
//i fixed it :)
session_start();
require 'dbUtils.php';
$conn = getConn();

if(!isset($_SESSION['userId'])) {
	header("Location: login.php");
}
$userId = $_SESSION['userId'];

//CARDS SESSION VARS
if (!isset($_SESSION['learnSession'])) $_SESSION['learnSession'] = 1;
if (!isset($_SESSION['counter'])) $_SESSION['counter'] = 0;
if (!isset($_SESSION['learnArray'])) $_SESSION['learnArray'] = array();

$learnArray = $_SESSION['learnArray'];
$arrayRef = $_SESSION['counter'];

//updating user review count
mysqli_query($conn, "UPDATE users SET reviewCount = reviewCount+1 WHERE userId = '$userId'");


//making the learn list
function makeLearnList()
{
	global $userId, $conn;
	$_SESSION['learnArray'] = array();
	$learnSession = $_SESSION['learnSession'];
	$selectSql = "SELECT cardId FROM spacedrepetition WHERE userId = '$userId' AND '$learnSession' % box = 0;";
	$cardQuery = mysqli_query($conn,$selectSql) or die(mysqli_error($conn));
	if (mysqli_num_rows($cardQuery)>=1) 
	{	
		while($row = mysqli_fetch_assoc($cardQuery)) 
		{
			array_push($_SESSION['learnArray'], $row["cardId"]);
		}
	}
	if ($_SESSION['learnArray'] == array()){
		array_push($_SESSION['learnArray'], rand(1,5));
	}
}
//function that adds cards to learn list
function startCards()
{
	global $conn, $userId;
	$addSql = "SELECT cardId FROM flashcards WHERE cardId NOT IN (SELECT cardId FROM spacedrepetition WHERE userId = '$userId') LIMIT 5;";
	$notStarted = mysqli_query($conn,$addSql) or die(mysqli_error($conn));
	if ((mysqli_num_rows($notStarted)>=1)) 
	{
		echo (mysqli_num_rows($notStarted)), " new card(s) added.";
		while ($row = mysqli_fetch_assoc($notStarted))
		{
			$cardId = $row["cardId"];
			$stmt = $conn->prepare("INSERT INTO spacedrepetition (userId, cardId) VALUES (?, ?)");
			if (!$stmt) die("DB PREPARE FAIL");
			if (!$stmt->bind_param("ii", $userId, $cardId)) die("BIND FAIL");
			if (!$stmt->execute()) die($conn->error);
		}
	makeLearnList();
	
	}
	else {
		echo "all cards started.";
	}
}
//fill list for first time
if ($_SESSION['learnArray'] == array()){
	startCards();
}
//function that chooses which cards to display:
function displayCard()
{
	global $conn;

	if ($_SESSION['counter'] < count($_SESSION['learnArray']))
	{
		$cardImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cardLoc FROM flashcards WHERE cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';"))['cardLoc'];
		echo "<div style='text-align:center';><img src='../img/",$cardImg,"' style='width:20%'';></div>";

	}
	else
	{
		$_SESSION['learnSession']++;
		makeLearnList();
		
		$_SESSION['counter'] = 0;
		$cardImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cardLoc FROM flashcards WHERE cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';"))['cardLoc'];
		echo "<div style='text-align:center';><img src='../img/",$cardImg,"' style='width:20%'';></div>";
	}
}

print_r($learnArray);
echo "<br> array counter is " . $_SESSION['counter'];  //echoes current value of counter
echo "<br> learn session is " .$_SESSION['learnSession'];
?>

<html>
<head>
<title>SPX Japanese</title>
<link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
</head>

<body>
<header>
<h1>Flashcards</h1>
</header>
<?php
	if ($_SESSION['role'] == 'admin' or $_SESSION['role'] == 'teacher') {
		require("teacherNav.php");
	}
	else {
		require("studentNav.php");
	}
	?>
<body>
	<main>
	<form method="POST" action=''>
	<br>
		<input type="submit" name="startCards"  value="Add 5 new cards">
	<br>
	</form> 
<?php

//buttons
if (isset($_POST['easy'])) {
	mysqli_query($conn, "UPDATE spacedrepetition SET box = box+2 WHERE userId = '$userId' AND cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';");
	$_SESSION['counter']++;
}
if (isset($_POST['normal'])) {
	mysqli_query($conn, "UPDATE spacedrepetition SET box = box+1 WHERE userId = '$userId' AND cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';");
	$_SESSION['counter']++;
}
if (isset($_POST['hard'])) {
	$_SESSION['counter']++;
}
if (isset($_POST['forgot'])) {
	mysqli_query($conn, "UPDATE spacedrepetition SET box = 1 WHERE userId = '$userId' AND cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';");
	$_SESSION['counter']++;
}
if (isset($_POST['startCards']))
{
	startCards();
}

displayCard();
?>

<div id="showAns" style="text-align:center" >
<?php echo "<p style='font-size:25px'>", mysqli_fetch_assoc(mysqli_query($conn, "SELECT cardAns FROM flashcards WHERE cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';"))['cardAns'], "</p>";
?>
<form method="POST" action=''style="text-align:center">
<input type="submit" name="easy"  value="Easy"><input type="submit" name="normal"  value="Normal"><input type="submit" name="hard"  value="Hard"><input type="submit" name="forgot"  value="Forgot">
</form>
</div>


<div style="text-align:center"><button onclick="myFunction()" >Show Answer</button></div>
<script>
document.getElementById("showAns").style.display = "none";
function myFunction() {
  var x = document.getElementById("showAns");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
	</main>	
</body>
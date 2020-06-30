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
}


//function that chooses which cards to display:

function displayCard()
{
	global $conn;

	if ($_SESSION['counter'] < count($_SESSION['learnArray']))
	{
		$cardImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cardLoc FROM flashcards WHERE cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';"))['cardLoc'];
		echo "<img src='../img/",$cardImg,"' style='width:20%' ;>";

	}
	else
	{
		$_SESSION['learnSession']++;
		makeLearnList();
		
		$_SESSION['counter'] = 0;
		$cardImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cardLoc FROM flashcards WHERE cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';"))['cardLoc'];
		echo "<img src='../img/",$cardImg,"' style='width:20%' ;>";

	}
}

print_r($learnArray);

//buttons

//adding new cards
if (isset($_POST['startCards']))
{
	
	
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
	displayCard();
	}
	else {
		echo "all cards started.";
	}
}



	

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
		<input type="submit" name="startList"  value="Begin Learning Session">
	</form> 
<?php
//other buttons
if (isset($_POST['easy'])) {
	mysqli_query($conn, "UPDATE spacedrepetition SET box = box+2 WHERE userId = '$userId' AND cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';");
	$_SESSION['counter']++;
	displayCard();
}
if (isset($_POST['normal'])) {
	mysqli_query($conn, "UPDATE spacedrepetition SET box = box+1 WHERE userId = '$userId' AND cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';");
	$_SESSION['counter']++;
	displayCard();
}
if (isset($_POST['hard'])) {
	$_SESSION['counter']++;
	displayCard();
}
if (isset($_POST['forgot'])) {
	mysqli_query($conn, "UPDATE spacedrepetition SET box = 1 WHERE userId = '$userId' AND cardId = '".$_SESSION['learnArray'][$_SESSION['counter']]."';");
	$_SESSION['counter']++;
	displayCard();
}
?>

<div id="showAns" style="text-align:center" >
The Answer is "a"
</div>
<button onclick="myFunction()">Show Answer</button>
<form method="POST" action=''style="text-align:center">
<input type="submit" name="easy"  value="Easy"><input type="submit" name="normal"  value="Normal"><input type="submit" name="hard"  value="Hard"><input type="submit" name="forgot"  value="Forgot">
</form>
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
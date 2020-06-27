<?php
session_start();
require 'dbUtils.php';
$conn = getConn();

if(!isset($_SESSION['userId'])) {
	header("Location: login.php");
}
$userId = $_SESSION['userId'];
//CARDS STUFF



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
	}
	else {
		echo "all cards started.";
	}
}
//displaying cards
$learnSession = 1;
$learnArray = array();
$selectSql = "SELECT cardId FROM spacedrepetition WHERE userId = '$userId' AND box/'$learnSession' = 1;";
$cardQuery = mysqli_query($conn,$selectSql) or die(mysqli_error($conn));
if (mysqli_num_rows($cardQuery)>=1) {	
		while($row = mysqli_fetch_assoc($cardQuery)) {
			array_push($learnArray, $row["cardId"]);
		}
}
print_r($learnArray);
//buttons
if (isset($_POST['easy'])){
	
}
if (isset($_POST['normal'])){
	
}
if (isset($_POST['hard'])){
	
}
if (isset($_POST['forgot'])){
	
}

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
		<input type="submit" name="startCards"  value="Start 5 New Cards">
	</form> 

<?php
$arrayRef = 0;
if ($arrayRef < count($learnArray))
{
	$cardImg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cardLoc FROM flashcards WHERE cardId ='$learnArray[$arrayRef]';"))['cardLoc'];
	echo "<img src='../img/",$cardImg,"' style='width:20%' ;>";
	$arrayRef += 1;
}
else
{
	$learnArray = array();
	$learnSession += 1;
	$arrayRef = 0;
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
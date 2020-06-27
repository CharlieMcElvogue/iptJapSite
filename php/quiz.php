<?php 
session_start();
require 'dbUtils.php';
$conn = getConn();
$meth = $_SERVER["REQUEST_METHOD"];
$sessionId = $_SESSION['sessionId'];


?>
<html>
<head>
<title>SPX Japanese</title>
<link href="../stylesheet.css" rel="stylesheet" type="text/css"> 
</head>

<body>
	<header>
		<h1>Quiz</h1>
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
		<h2>Le Japon Quiz</h2>
		
		<form name="quiz" action="" method="post">
		<h4>Q1. The character "う" is equivilent to:</h4>
		<label><input type="radio" name="q1" required value="0">a</label>
		<label><input type="radio" name="q1" required value="0">i</label>
		<label><input type="radio" name="q1" required value="1">u</label>
		<label><input type="radio" name="q1" required value="0">e</label>
		<br>
		<h4>Q2. The character "お" is equivilent to:</h4>
		<label><input type="radio" name="q2" required value="1">o</label>
		<label><input type="radio" name="q2" required value="0">i</label>
		<label><input type="radio" name="q2" required value="0">e</label>
		<label><input type="radio" name="q2" required value="0">u</label>
		<br>
		<h4>Q3. ???</h4>
		<label><input type="radio" name="q3" required value="0">o</label>
		<label><input type="radio" name="q3" required value="0">i</label>
		<label><input type="radio" name="q3" required value="0">e</label>
		<label><input type="radio" name="q3" required value="1">u</label>
		<br>
		<h4>Q4. ???</h4>
		<label><input type="radio" name="q4" required value="0">o</label>
		<label><input type="radio" name="q4" required value="0">i</label>
		<label><input type="radio" name="q4" required value="0">e</label>
		<label><input type="radio" name="q4" required value="1">u</label>
		<br>
		<h4>Q5. ???</h4>
		<label><input type="radio" name="q5" required value="0">o</label>
		<label><input type="radio" name="q5" required value="1">i</label>
		<label><input type="radio" name="q5" required value="0">e</label>
		<label><input type="radio" name="q5" required value="0">u</label>
		<br>
		<h4>Q6. ???</h4>
		<label><input type="radio" name="q6" required value="1">o</label>
		<label><input type="radio" name="q6" required value="0">i</label>
		<label><input type="radio" name="q6" required value="0">e</label>
		<label><input type="radio" name="q6" required value="0">u</label>
		<br>
		<h4>Q7. ???</h4>
		<label><input type="radio" name="q7" required value="0">o</label>
		<label><input type="radio" name="q7" required value="1">i</label>
		<label><input type="radio" name="q7" required value="0">e</label>
		<label><input type="radio" name="q7" required value="0">u</label>
		<br>
		<h4>Q8. ???</h4>
		<label><input type="radio" name="q8" required value="0">o</label>
		<label><input type="radio" name="q8" required value="0">i</label>
		<label><input type="radio" name="q8" required value="1">e</label>
		<label><input type="radio" name="q8" required value="0">u</label>
		<br>
		<h4>Q9. ???</h4>
		<label><input type="radio" name="q9" required value="0">o</label>
		<label><input type="radio" name="q9" required value="0">i</label>
		<label><input type="radio" name="q9" required value="0">e</label>
		<label><input type="radio" name="q9" required value="1">u</label>
		<br>
		<h4>Q10. ???</h4>
		<label><input type="radio" name="q10" required value="0">o</label>
		<label><input type="radio" name="q10" required value="0">i</label>
		<label><input type="radio" name="q10" required value="1">e</label>
		<label><input type="radio" name="q10" required value="0">u</label>
		<br>
	
		<label><button name="quizSubmit" type="submit"> Answer Quiz</button></label>
	<br>
	<?php	
if(isset($_POST["quizSubmit"])) 
{
	$total = 0;
	$count = 0;
	foreach($_POST as $ans) 
	{
		$total += intval($ans);
	}
	$total = ($total/(count($_POST)-1));
	echo "You answered ", ($total*100),"% of questions correctly.";
	
	//update sessioninfo with score
	echo $total;
	$updateSql = "UPDATE sessioninfo SET quizScore='$total' WHERE sessionId='$sessionId'";

	if (mysqli_query($conn, $updateSql)) 
	{
		echo "<br> Record updated successfully";
	} 
	else 
	{
		echo "Error updating record: " . mysqli_error($conn);
	}

}
#($total/(count($_POST)-1)	
?>
	</main>

</body>
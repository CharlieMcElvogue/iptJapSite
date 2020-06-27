<?php
session_start();
session_unset();
session_destroy();
?>

<! DOCTYPE html>
<html>
<head>
	<title>Logging out...</title>
</head>
<body>
<p>Logging out...</p>
<meta http-equiv="refresh" content="1;url=login.php" />
</body>
</html>
<?php
	include 'common.php';
    if(!empty($_SESSION['user'])) 
    { 
        // If they are, we redirect them to the login page. 
        header("Location: course.php"); 
        die("Redirecting to course.php"); 
    } 
?>
<html>
	<head><title>Whiteboard | Home</title>
	<link href="CSS/main.css" rel="stylesheet" type="text/css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
	<script src="JS/functions.js"></script>
	</head>
	<body onresize="loginload()" onload="loginload()">
		<div id="whiteboard">
			<h1 align="center">Whiteboard</h1>
			<div id="login">
			<p align="center"><img src="Images/logo.png"/></p>
			<form onsubmit="return Login()">
				<h3 align="center">Log-in to Continue</h3>
				<p>Username <input id="username" type="text"></p>
				<p>Password <input id="password" type="password"></p>
				<input id="submit" type="submit" value="Log-in"><br/>
				<p id="footnote" style="font-size: 9px; color: rgba(90,90,90,0.5); margin-top: 4px;" align="center">Developed by Jamie Hankins & Matthew James | <a href="register.php">Register</a><br />
		</div>
			</form>
		</div>
		</div>
	</body>
</html>
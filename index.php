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
	<script>
		function Login(){
			var valueUsername = $("#username").val()
			var valuePassword = $("#password").val()
			document.getElementById('footnote').innerHTML = "Logging In.";
			
			$.post('login.php', { username: valueUsername, password: valuePassword }).done(function(data)
			{
				console.log(data);

				if(data.indexOf("true") !== -1)
				{
					document.getElementById('footnote').innerHTML = "Logged In.";
					document.getElementById('login').style.opacity = 0;
					document.getElementsByTagName('h1').item(0).opacity = 0;
					setTimeout(function() 
					{
						window.location = "course.php";
					}, 1000);
				}


				setTimeout(function() {
					var o = document.getElementById('login');
					o.style.left = window.innerWidth / 2 - 125 + 10;
					setTimeout(function() {
						o.style.left = window.innerWidth / 2 - 125 - 10;
						setTimeout(function() {
							o.style.left = window.innerWidth / 2 - 125;
						}, 220);
					document.getElementById('footnote').innerHTML = "Login Failed.";
					document.getElementById('footnote').style.color = 'red';
					setTimeout(function() {
						document.getElementById('footnote').innerHTML = "Developed by Jamie Hankins & Matthew James";
						document.getElementById('footnote').style.color = 'rgba(90,90,90,0.5)';
						}, 1500);
					}, 220);
				}, 2000);
				
			});
			return false;
	}
	function load(){
		var o = document.getElementById('login');
		o.style.left = window.innerWidth / 2 - 125;
	}
	</script>
	</head>
	<body onresize="load()" onload="load()">
		<div id="whiteboard">
			<h1 align="center">Whiteboard</h1>
			<div id="login">
			<p align="center"><img src="Images/logo.png"/></p>
			<form onsubmit="return Login()">
				<h3 align="center">Log-in to Continue</h3>
				<p>Username <input id="username" type="text"></p>
				<p>Password <input id="password" type="password"></p>
				<input id="submit" type="submit" value="Log-in"><br/>
				<p id="footnote" style="font-size: 9px; color: rgba(90,90,90,0.5); margin-top: 4px;" align="center">Developed by Jamie Hankins & Matthew James</div>
			</form>
		</div>
		</div>
	</body>
</html>
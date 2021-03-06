<?php
session_start();
if(!empty($_SESSION['user'])) 
    { 
        // If they are, we redirect them to the login page. 
        header("Location: course.php"); 
        die("Redirecting to course.php"); 
    } 
?>

<html>
	<head><title>Whiteboard | Home</title>
	<link href="CSS/bootstrap.css" rel="stylesheet" type="text/css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
	<script src="JS/functions.js"></script>
        <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
	</head>

	<body onload="loginload()">
    <div class="container">
      <form method="post" class="form-signin" onsubmit="return Login()">
        <h2 class="form-signin-heading">Whiteboard</h2>
        <p>Log-in to Continue</p>
        <input type="text" class="input-block-level" name="username" placeholder="Username">
        <input type="password" class="input-block-level" name="password" placeholder="Password">
        <input type="text" class="input-block-level" name="email" placeholder="E-mail (if signing-up)">
        <button class="btn btn-medium btn-primary" type="submit" onclick='this.form.action="login.php";'>Sign in</button>
        <button class="btn btn-medium btn-info" type="submit" onclick='this.form.action="register.php";'>Register</button>
      </form>
  </div>
</body>
</html>

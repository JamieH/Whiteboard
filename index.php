<?php
	include 'common.php';
    if(!empty($_SESSION['user'])) 
    { 
        // If they are, we redirect them to the login page. 
        header("Location: course.php"); 
        die("Redirecting to course.php"); 
    } 
     if(!empty($_POST)) 
    { 
        // Ensure that the user has entered a non-empty username 
        if(empty($_POST['username'])) 
        { 
            //TODO: Add proper errors
            die("Please enter a username."); 
        } 
         
        // Ensure that the user has entered a non-empty password 
        if(empty($_POST['password'])) 
        { 
            //TODO: Add proper errors
            die("Please enter a password."); 
        } 
         
        // Make sure the user entered a valid E-Mail address 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            die("Invalid E-Mail Address"); 
        } 
         
        // Does it alredy exist?
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
        
        //Parameters
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try 
        { 
            // These two statements run the query against your database table. 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        
        catch(PDOException $ex) 
        { 
            dieError($ex);
        }
          
         
        // The fetch() method returns an array representing the "next" row from 
        // the selected results, or false if there are no more rows to fetch. 
        $row = $stmt->fetch(); 
         
        // If a row was returned, then we know a matching username was found in 
        // the database already and we should not allow the user to continue. 
        if($row) 
        { 
            die("This username is already in use"); 
        } 
         
        // Now we perform the same type of check for the email address, in order 
        // to ensure that it is unique. 
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            dieError($ex);
        }
         
        $row = $stmt->fetch(); 
         
        if($row) 
        { 
            die("This email address is already registered"); 
        } 
         
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        "; 
         

         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk).
        $passwordDetails = genPass($_POST['password']);

        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $passwordDetails['password'], 
            ':salt' => $passwordDetails['salt'],
            ':email' => $_POST['email'] 
        ); 
         
        try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            dieError($ex);
        }
        
        $sessiondetails = $query_params;
        unset($row['salt']); 
        unset($row['password']);



        $username = $_POST['username'];
        $id = getID($db, $_POST['email']);
        $email = $_POST['email'];

        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['id'] = $id;
        $_SESSION['user']['email'] = $email;
        
        // This redirects the user back to the login page after they register 
        header("Location: course.php"); 
        die("Redirecting to course.php"); 
    } 
     
?>
<html>
	<head><title>Whiteboard | Home</title>
	<link href="CSS/main.css" rel="stylesheet" type="text/css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
	<script src="JS/functions.js"></script>
    <script>
        $('#git').cycle({
            fx: "scrollLeft",
            next: "#git",
            delay: -3000, 
        });
    </script>
    <style>
        #git{
           background: #eaeaea; /* Old browsers */
    background: -moz-linear-gradient(top,  #fcfcfc 0%, #eaeaea 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fcfcfc), color-stop(100%,#eaeaea)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #fcfcfc 0%,#eaeaea 100%); /* IE10+ */
    background: linear-gradient(to bottom,  #fcfcfc 0%,#eaeaea 100%); /* W3C */r: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cfb50c39', endColorstr='#b8a50404',GradientType=0 ); /* IE6-9 */

width: 60%;
height: 40px;
font-size: 17px;
position: absolute;
bottom: 0px;
left: 20%;
border-top-right-radius: 20px;
border-top-left-radius: 20px;
color: white;
        }
    </style>
	</head>
	<body onresize="loginload()" onload="loginload()">
		<div id="mainbackground">
			<h1 align="center">Whiteboard</h1>
			<div id="whiteboard" class="login">
				<p align="center"><img src="Images/logo.png"/></p>
				<form onsubmit="return Login()">
					<h3 align="center">Log-in to Continue</h3>
					<p>Username <input id="username" type="text"></p>
					<p>Password <input id="password" type="password"></p>
					<input id="submit" type="submit" value="Log-in"><br/>
					<div id="footnote"><p>Developed by Jamie Hankins & Matthew James |</p><p id="link" onclick="askregistration()">Register</p></div><br />
				</form>
			</div>
			<div id="whiteboard" class="register" style="display: none;">
				<p align="center" style="margin-bottom: 0px;"><img src="Images/logo.png"></p>
				<h3 align="center" style="margin-top: 5px;margin-bottom: 0px;">Register</h3>
				<form method="post" style="margin-bottom: 0px;"> 
    				<p style="margin-top: 6px;">Username: <input type="text" name="username" value=""></p>
    				<p>E-Mail:<input type="text" name="email" value=""> </p>
  					<p> Password:<input type="password" name="password" value=""> </p> 
   					<input type="submit" value="Register" style="width: 90px;">
   					<div id="footnote"><p>Developed by Jamie Hankins & Matthew James | </p><p id="link" onclick="askregistration()">Login</p></div><br />
				</form>
			</div>
		</div>
		</div>
        <div id="git">
            <?php
                for($i=1; $i<4; $i++){
                    echo "<p align='center'>" . shell_exec("git log -" . $i " --pretty=format:'%h - %s (%ci)' --abbrev-commit") . "</p>";
                }
            ?>
        </div>
	</body>
</html>
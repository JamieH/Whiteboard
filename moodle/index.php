<?php
include '../common.php';
    
if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: index.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.html"); 
    } 
?>

<html>
<head>
<title>IT Extended Diploma Level 3 - Whiteboard</title>
<link href="../CSS/course.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
<script src="../JS/functions.js"></script>
</head>
<body onload="loadafterlogin()" onresize="IDPanelPlacement()">
<?php include'../header.php';?>
<div id="content">
<h1>Moodle Import Script</h1>
<?php
include 'moodle.php';
authWithMoodle("jhankins", "http://elib.strode-college.ac.uk/moodle/login/index.php", $_GLOBAL['db']);
?>
</div>
<br/>
<?php include'../footer.php';?>
</body>
</html>
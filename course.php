<?php
include 'common.php';
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
<title><?php echo "IT Extended Diploma Level 3 - Whiteboard";?></title>
<link href="CSS/course.css" rel="stylesheet" type="text/css"> </link>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
<script src="http://malsup.github.io/jquery.cycle.all.js"></script>
<script src="JS/functions.js"></script>
</head>
<body onload="loadafterlogin()" onresize="IDPanelPlacement()">
<?php include'header.php';?>
<div id="content">
	<h2 align="center"> IT Extended Diploma Level 3</h2>
	<div class="expand" id="Unit 2 - Computer Systems" score="U">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="course_view.php?ref=IT+Extended+Diploma+Level+3">More information on this course.</a></p>
	</div>
	<div class="expand"  id="Unit 6 - Computer Systems" score="P">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
	<div class="expand"   id="Unit 14 - Computer Systems" score="M">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
	<div class="expand"   id="Unit 28 - Computer Systems" score="D">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
	<div class="expand"  id="Unit 21 - Computer Systems" score="U">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
</div>
<br/>
<?php include'footer.php';?>
</body>
</html>
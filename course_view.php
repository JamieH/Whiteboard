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
<link href="CSS/course.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
<script src="JS/functions.js"></script>
</head>
<body onload="loadafterlogin()" onresize="IDPanelPlacement()">
	<?php 
        include('header.php');
    ?>
<div id="content">
	<h2 align="center"> IT Extended Diploma Level 3</h2>
	<div id="Unit 2 - Computer Systems" score="U">
		<h2 align="center">Welcome to Unit 2</h2>
		<div class="summary">
    <p><span style="color: FC8D0F; font-size: large"><strong>Aim</strong></span></p> 
    <p>The aim of this unit is to enable learners to understand the components of computer systems and develop the skills needed to recommend appropriate systems for business purposes and set up and maintain computer systems.</p> 
    <p><span style="color: FC8D0F;"><strong>Unit Content</strong></span></p> 
    <p>At some stage most IT professionals will have to set up and customise a computer system or systems. To do so effectively they will need to understand the components that make up computer systems. The operating system interacts with the hardware and software components in order to make a functioning machine.</p> 
    <p><br>In this unit learners will consider a range of hardware and come to understand the technical specifications of components. There are a number of different operating systems, despite the dominance of the Microsoft operating system, and learners will explore at least one other. In terms of software, the operating system itself often provides utility programmes that assist the user in managing the machine. Other third party software utility programmes such as virus checkers are also used extensively. This unit considers both types of utility software.</p> 
    <p><br>IT professionals will often be asked to recommend systems for varied user needs. There are many different manufacturers of computer systems and each manufacturer produces a wide range of models with different specifications. Deciding which particular model is appropriate for a given situation depends on a variety of factors. These factors are explored in this unit so that learners can make informed choices when recommending computer systems.</p> 
    <p><br>IT professionals also need to develop the skills required to install and configure computer systems. A large part of this unit will involve practical work in installing hardware components and software, configuring systems to meet specific requirements and testing to ensure a fully functioning system is produced.</p>
</div>
	</div>
</div>
<br/>
<?php include'footer.php';?>
</body>
</html>
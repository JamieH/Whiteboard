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
<title><?php echo "IT Extended Diploma Level 3 - Whiteboard";?></title>
<link href="../CSS/course.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
<script src="../JS/functions.js"></script>
</head>
<body onload="loadafterlogin()" onresize="IDPanelPlacement()">
<?php include'../header.php';?>
<div id="content">
	<h2 align="center"> IT Extended Diploma Level 3</h2>
<?php
    include 'moodle.php';
    if(!empty($_POST)) 
    {
        $newusername = '';

        //if username is not the old one and password is not empty
        if($_POST['username'] != $_SESSION['user']['moodleusername'] and !empty($_POST['password'])) 
        { 
            $newusername = addDetails($_POST['username'], $_POST['password'], $_SESSION['user']['id'], $db);
        }
        //if username is not old one and password IS empty
        elseif ($_POST['username'] != $_SESSION['user']['moodleusername'] and empty($_POST['password']))
        {
            $newusername = addDetails($_POST['username'], null, $_SESSION['user']['id'], $db);

        }
        //else if username is the same but password is different
        elseif ($_POST['username'] = $_SESSION['user']['moodleusername'] and !empty($_POST['password']))
        {
            $newusername = addDetails($_POST['username'], $_POST['password'], $_SESSION['user']['id'], $db);
        } 
        else
        {
            $newusername = $_SESSION['user']['moodleusername'];
        }
         
        // Now that the user's E-Mail address has changed, the data stored in the $_SESSION 
        // array is stale; we need to update it so that it is accurate. 
        $_SESSION['user']['moodleusername'] = $newusername; 
         
        // This redirects the user back to the members-only page after they register 
        header("Location: ../course.php"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to course.php"); 
    } 
     
?> 

<h1>Edit Account</h1> 
<form action="profile.php" method="post"> 
    Username:<br /> 
    <input type="text" name="username" value="<?php echo htmlentities($_SESSION['user']['moodleusername'], ENT_QUOTES, 'UTF-8'); ?>" /> 
    <br /><br />

    Password:<br /> 
    <input type="password" name="password" value="" /><br /> 
    <i>(You must re-enter your password)</i> 
    <br /><br /> 
    <input type="submit" value="Update Account" /> 
</form>

<a href="../course.php">Go Back</a><br />

</div>
<br/>
<?php include'../footer.php';?>
</body>
</html>
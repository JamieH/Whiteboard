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
<script>
function load(){
	for(var i = 0; i < document.getElementsByClassName('expand').length; i++){
		temp = document.getElementsByClassName('expand').item(i);
		temp.innerHTML = "<h3 id='expandtitle' align='center'>" + temp.id + "</h3>" + temp.innerHTML;
		var s = temp.getAttribute('score');
		var scorefinal = "unitu";
		if(s != "U"){
			scorefinal = "unitp";
			if(s == null){
				s = "U";
				scorefinal = "unitu";
			}
		}
		temp.innerHTML = "<div class='unitgrade' id='" + scorefinal + "'>" + s + "</div>" + temp.innerHTML;
		temp.setAttribute('onclick', 'expand(' + i + ',true)');
	}
}
function expand(id, operation){
	if (operation == false){
		document.getElementsByClassName('expand').item(id).style.height = "40px";
		document.getElementsByClassName('expand').item(id).setAttribute('onclick', 'expand(' + id + ',true)');
	}
	else{
		document.getElementsByClassName('expand').item(id).style.height = "auto";
		document.getElementsByClassName('expand').item(id).setAttribute('onclick', 'expand(' + id + ',false)');
	}
}
</script>
</head>
<body onload="load()">
<?php include'header.php';?>
<div id="content">
	<h2 align="center"> IT Extended Diploma Level 3</h2>
<?php
    if(!empty($_POST)) 
    { 
        if($_POST['email'] != $_SESSION['user']['email']) 
        { 
            $newemail = editEmail($_SESSION['user']['email'], $_POST['email']);
        } 

        if(!empty($_POST['password'])) 
        { 
            $password = genPass($_POST['password']);
        }
         
        // Now that the user's E-Mail address has changed, the data stored in the $_SESSION 
        // array is stale; we need to update it so that it is accurate. 
        $_SESSION['user']['email'] = $newemail; 
         
        // This redirects the user back to the members-only page after they register 
        header("Location: private.php"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to private.php"); 
    } 
     
?> 

<h1>Edit Account</h1> 
<form action="edit_account.php" method="post"> 
    Username:<br /> 
    <b><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></b> 
    <br /><br /> 
    E-Mail Address:<br /> 
    <input type="text" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>" /> 
    <br /><br /> 
    Password:<br /> 
    <input type="password" name="password" value="" /><br /> 
    <i>(leave blank if you do not want to change your password)</i> 
    <br /><br /> 
    <input type="submit" value="Update Account" /> 
</form>

<a href="course.php">Go Back</a><br />

</div>
<br/>
</body>
</html>
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
    $query = " 
        SELECT 
            id, 
            username, 
            email 
        FROM users 
    "; 
     
    try 
    { 
        // These two statements run the query against your database table. 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
        catch(PDOException $ex) 
        { 
            if ($debug)
            {
                die("Failed to run query: " . $ex->getMessage()); 
            }
            else
            {
                die("Database issues.");
            }
        }
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt->fetchAll(); 
?> 
<h1>Memberlist</h1> 
<table> 
    <tr> 
        <th>ID</th> 
        <th>Username</th> 
        <th>E-Mail Address</th> 
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo $row['id']; ?></td> <!-- htmlentities is not needed here because $row['id'] is always an integer --> 
            <td><?php echo htmlentities($row['username'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); ?></td> 
        </tr> 
    <?php endforeach; ?> 
</table> 
<a href="course.php">Go Back</a><br />

</div>
<br/>
</body>
</html>
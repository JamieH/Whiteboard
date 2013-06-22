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

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Whiteboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Interface built for Moodle">
    <meta name="author" content="Jamie Hankins">
    <?php
    
    if (isset($_SESSION['user']['theme']))
    {
      if (file_exists("CSS/themes/".$_SESSION['user']['theme']))
      {
        echo '<link href="CSS/themes/' . $_SESSION['user']['theme'] . '" rel="stylesheet">';
      }
      else
      {
      echo '<link href="CSS/themes/flatly.css" rel="stylesheet">';
      }
    }
    else
    {
      echo '<link href="CSS/themes/flatly.css" rel="stylesheet">';
    }
    ?>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .row
      {
        padding-bottom: 5px;
      }

    </style>

    <link href="CSS/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="JS/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
  </head>
<body>

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
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Whiteboard</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="#">Assignments</a></li>
              <li><a href="#">Tracking Sheet</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    <div class="page-header">
    <h2 align="center"> IT Extended Diploma Level 3</h2>
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




      <hr>

      <footer>
        <p>&copy; Jamie Hankins 2013</p>
      </footer>
    </div>
</body>
</html>
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
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
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
    <link href="CSS/bootstrap-responsive.css" rel="stylesheet">
    <link href="CSS/bootstrap-formhelpers.css" rel="stylesheet">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="JS/bootstrap.js"></script>
    <script src="JS/api.js"></script>
    <script src="JS/bootstrap-formhelpers-selectbox.js"></script>


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <![endif]-->
  </head>


<body>
<div id="content">
	<h2 align="center"> IT Extended Diploma Level 3</h2>



<?php
function getDirectoryList ($directory) 
  {

    // create an array to hold directory list
    $results = array();

    // create a handler for the directory
    $handler = opendir($directory);

    // open directory and walk through the filenames
    while ($file = readdir($handler)) {

      // if file isn't this directory or its parent, add it to the results
      if ($file != "." && $file != "..") {
        $results[] = $file;
      }

    }

    // tidy up: close the handler
    closedir($handler);

    // done!
    return $results;

  }

    if(!empty($_POST)) 
    { 
        include '\moodle\moodle.php';

        $newusername = '';

        //if username is not the old one and password is not empty
        if ( $_POST['username'] != $_SESSION['user']['moodleusername'] and !empty( $_POST['mpassword'] ) ) {
            $newusername = addDetails( $_POST['musername'], rot13encrypt( $_POST['mpassword'] ), $_SESSION['user']['id'], $db );
        }
        //if username is not old one and password IS empty
        elseif ( $_POST['username'] != $_SESSION['user']['moodleusername'] and empty( $_POST['mpassword'] ) ) {
            $newusername = addDetails( $_POST['musername'], null, $_SESSION['user']['id'], $db );

        }
        //else if username is the same but password is different
        elseif ( $_POST['username'] = $_SESSION['user']['moodleusername'] and !empty( $_POST['mpassword'] ) ) {
            $newusername = addDetails( $_POST['musername'], rot13encrypt( $_POST['mpassword'] ), $_SESSION['user']['id'], $db );
        }
        else {
            $newusername = $_SESSION['user']['moodleusername'];
        }

        // Now that the user's E-Mail address has changed, the data stored in the $_SESSION
        // array is stale; we need to update it so that it is accurate.

        if($_POST['email'] != $_SESSION['user']['email']) 
        { 
            $newemail = editEmail($_SESSION['user']['email'], $_POST['email'], $db);
        }
        else
        {
            $newemail = $_SESSION['user']['email'];
        }
        

        if(!empty($_POST['password'])) 
        { 
            $password = genPass($_POST['password']);
        }

        if(empty($_POST['theme'])) 
        { 
          if (!isset($_SESSION['theme']))
          {
            $theme = "flatly.css";
          }
          else
          {
            $theme = $_SESSION['theme'];
          }
        }
        else
        {
            $theme = strip_tags(htmlentities($_POST['theme']));
            editSkin($_SESSION['user']['username'], $theme, $db);
        }

         
        // Now that the user's E-Mail address has changed, the data stored in the $_SESSION 
        // array is stale; we need to update it so that it is accurate. 
        $_SESSION['user']['email'] = $newemail; 
        $_SESSION['user']['moodleusername'] = $newusername;
        $_SESSION['user']['theme'] = $theme;
        // This redirects the user back to the members-only page after they register 
        header("Location: course.php"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to course.php");     } 
?>

<div class="container">
    <h3>Account Settings</h3>
<form class="form-horizontal" action="profile.php" method="post"> 
  <div class="control-group">
    <label class="control-label" for="username">Username</label>
    <div class="controls">
      <input type="text" name="username" value="<?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="text" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="musername">Moodle Username</label>
    <div class="controls">
      <input type="text" name="musername" value="<?php echo htmlentities($_SESSION['user']['moodleusername'], ENT_QUOTES, 'UTF-8'); ?>">
    </div>
  </div>

    <div class="control-group">
    <label class="control-label" for="mpassword">Moodle Password</label>
    <div class="controls">
      <input type="password" name="mpassword" placeholder="Moodle Password">
    </div>
  </div>

  <div class="control-group">
    <label class="control-label" for="theme">Theme. Want to create your own? Try <a href="http://www.lavishbootstrap.com/">this</a> or <a href="http://www.bootstrapthemeroller.com/twitter-bootstrap-themeroller.html">this</a>. Just give the admin the file to upload.</label>
    <div class="controls">

    <div class="bfh-selectbox">
  <input type="hidden" name="theme" value="">
  <a class="bfh-selectbox-toggle" role="button" data-toggle="bfh-selectbox" href="#">
    <span class="bfh-selectbox-option input-medium" data-option="<?php echo htmlentities($_SESSION['user']['theme'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlentities($_SESSION['user']['theme'], ENT_QUOTES, 'UTF-8'); ?></span>
    <b class="caret"></b>
  </a>
  <div class="bfh-selectbox-options">
  <div role="listbox">
    <ul role="option">
        <?php
        $themearray = getDirectoryList("CSS/themes");
            foreach ($themearray as $value)
            {
                echo '<li><a tabindex="-1" href="#" data-option="' . $value . '">' . $value . "</a></li>";
            }
        ?>

      <Option 1

    </ul>
    </div>
  </div>
</div>    
</div>
  </div>


  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <input type="password" id="inputPassword" placeholder="Password">
    </div>
  </div>

  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Edit Account</button>
    </div>
  </div>

</form>
<a href="course.php">Go Back</a><br />
</div>
</div>
<br/>
</body>
</html>
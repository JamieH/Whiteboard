<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Whiteboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Interface built for Moodle">
    <meta name="author" content="Jamie Hankins">
    <?php
        session_start();

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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="JSo/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="JSo/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="JSo/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="JSo/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="JSo/favicon.png">
  </head>

  <body onload="loginAuth()">

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
    <?php
    if (!isset($_SESSION['user']['moodleusername']))
    {
    echo "<h3>Please fill in your Moodle Details <a href='moodle/profile.php'>here</a></h3>";
    }
    ?>
    </div>
    <h2 id="remove">Please wait loading</h2>
    <div id="stuffhere">

    </div>




      <hr>

      <footer>
        <p>&copy; Jamie Hankins 2013</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/api.js"></script>
  </body>
</html>

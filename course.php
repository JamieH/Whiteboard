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

    .clearfix{*zoom:1;}.clearfix:before,.clearfix:after{display:table;content:"";line-height:0;}
    .clearfix:after{clear:both;}
    .hide-text{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0;}
    .input-block-level{display:block;width:100%;min-height:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}
    .btn-file{overflow:hidden;position:relative;vertical-align:middle;}.btn-file>input{position:absolute;top:0;right:0;margin:0;opacity:0;filter:alpha(opacity=0);transform:translate(-300px, 0) scale(4);font-size:23px;direction:ltr;cursor:pointer;}
    .fileupload{margin-bottom:9px;}.fileupload .uneditable-input{display:inline-block;margin-bottom:0px;vertical-align:middle;cursor:text;}
    .fileupload .thumbnail{overflow:hidden;display:inline-block;margin-bottom:5px;vertical-align:middle;text-align:center;}.fileupload .thumbnail>img{display:inline-block;vertical-align:middle;max-height:100%;}
    .fileupload .btn{vertical-align:middle;}
    .fileupload-exists .fileupload-new,.fileupload-new .fileupload-exists{display:none;}
    .fileupload-inline .fileupload-controls{display:inline;}
    .fileupload-new .input-append .btn-file{-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0;}
    .thumbnail-borderless .thumbnail{border:none;padding:0;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}
    .fileupload-new.thumbnail-borderless .thumbnail{border:1px solid #ddd;}
    .control-group.warning .fileupload .uneditable-input{color:#a47e3c;border-color:#a47e3c;}
    .control-group.warning .fileupload .fileupload-preview{color:#a47e3c;}
    .control-group.warning .fileupload .thumbnail{border-color:#a47e3c;}
    .control-group.error .fileupload .uneditable-input{color:#b94a48;border-color:#b94a48;}
    .control-group.error .fileupload .fileupload-preview{color:#b94a48;}
    .control-group.error .fileupload .thumbnail{border-color:#b94a48;}
    .control-group.success .fileupload .uneditable-input{color:#468847;border-color:#468847;}
    .control-group.success .fileupload .fileupload-preview{color:#468847;}
    .control-group.success .fileupload .thumbnail{border-color:#468847;}

    </style>

    <link href="CSS/bootstrap-responsive.css" rel="stylesheet">
    <link href="CSS/ajaxfileupload.css"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="JS/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
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
    <script src="JS/ajaxfileupload.js"></script>

<script type="text/javascript">
  function ajaxFileUpload(obj)
  {
    console.log(obj.id);
    console.log(obj.id + 'f');
    $("#loading")
    .ajaxStart(function(){
      $(this).show();
    })
    .ajaxComplete(function(){
      $(this).hide();
    });

    $.ajaxFileUpload
    (
      {
        url:'upload.php',
        secureuri:false,
        fileElementId:obj.id + 'f',
        console.log($(obj.id + 'f').html());
        dataType: 'json',
        data:{name:'logan', id: obj.id},
        success: function (data, status)
        {
          if(typeof(data.error) != 'undefined')
          {
            if(data.error != '')
            {
              alert(data.error);
            }else
            {
              alert(data.msg);
            }
          }
        },
        error: function (data, status, e)
        {
          alert(e);
        }
      }
    )
    
    return false;

  }
  </script> 

  </body>
</html>

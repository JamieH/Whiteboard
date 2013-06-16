<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Whiteboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="CSS/bootstrap.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="JS/bootstrap.js"></script>
    <script src="JS/api.js"></script>

    <link href="CSS/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body onload="loginAuth()">

    <div class="navbar navbar-inverse">
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
              <li><a href="index.html">Home</a></li>
              <li><a href="profile.html">Profile</a></li>
              <li><a href="Assignments">Assignments</a></li>
              <li><a href="Assignments">Tracking Sheet</a></li>
              <li><a href="Assignments">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<div class="container">
    <div class="page-header">
		<h2 align="center"> IT Extended Diploma Level 3</h2>
    </div>

    <div class="btn-group btn-block">
  <a class="btn btn-info btn-large btn-block btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
    Action
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
<li><a href="#">Get Assignments</a></li>
<li><a href="#">View Resources</a></li>
<li><a href="#">Get Feedback</a></li>
</ul>
</div>



<div id="units">
  <div id="unit">
  <h4>Assignments for <span class="badge">Unit</span></h4>
  <div class="btn-group">
    <button class="btn btn-primary">Left</button>
    <button class="btn btn-primary">Middle</button>
    <button class="btn btn-primary">Right</button>
  </div>
</div>
</div>
<h4>Feedback for <span class="badge">Unit</span></h4>
<div class="well">
<h4>Assignment One</h4>
Assignment one, P1 M1, D1
</div>
<div class="well">
<h4>Assignment Two</h4>
Assignment Two, P1 M1, D1
</div>
<div>
  </body>
</html>

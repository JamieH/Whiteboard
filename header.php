  <?php
  if (!isset($_SESSION['user']['moodleusername']))
  {
    echo "<h1>Please fill in your Moodle Details <a href='moodle/profile.php'>here</a></h1>";
  }
  ?>

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
              <li><a href="index.php">Home</a></li>
              <li><a href="profile.php">Profile</a></li>
              <li><a href="Assignments">Assignments</a></li>
              <li><a href="Assignments">Tracking Sheet</a></li>
              <li><a href="Assignments">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
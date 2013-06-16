<div id="content">
  <?php
  if (!isset($_SESSION['user']['moodleusername']))
  {
    echo "<h1>Please fill in your Moodle Details <a href='moodle/profile.php'>here</a></h1>";
  }
  ?>
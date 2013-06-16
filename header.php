<?php include'header.php';?>


<div id="content">
  <?php
  if (!isset($_SESSION['user']['moodleusername']))
  {
    echo "<h1>Please fill in your Moodle Details <a href='moodle/profile.php'>here</a></h1>";
  }
  ?>

    <div id="header"></div>

    <div id="wrap">

      <div class="container">
        <div class="page-header">
  <h2 align="center"> IT Extended Diploma Level 3</h2>
        </div>
        <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS.</p>
        <p>Use <a href="./sticky-footer-navbar.html">the sticky footer</a> with a fixed navbar if need be, too.</p>



  <div class="expand" id="Unit 2 - Computer Systems" score="U">
    <p> Assignments</p>
    <p> Upload Area</p>
    <p class="upload"> upload area 1</p>
    <p> <a href="course_view.php?ref=IT+Extended+Diploma+Level+3">More information on this course.</a></p>
  </div>
  <div class="expand"  id="Unit 6 - Computer Systems" score="P">
    <p> Assignments</p>
    <p> Upload Area</p>
    <p class="upload"> upload area 1</p>
    <p> <a href="">More information on this course.</a></p>
  </div>
  <div class="expand"   id="Unit 14 - Computer Systems" score="M">
    <p> Assignments</p>
    <p> Upload Area</p>
    <p class="upload"> upload area 1</p>
    <p> <a href="">More information on this course.</a></p>
  </div>
  <div class="expand"   id="Unit 28 - Computer Systems" score="D">
    <p> Assignments</p>
    <p> Upload Area</p>
    <p class="upload"> upload area 1</p>
    <p> <a href="">More information on this course.</a></p>
  </div>
  <div class="expand"  id="Unit 21 - Computer Systems" score="U">
    <p> Assignments</p>
    <p> Upload Area</p>
    <p class="upload"> upload area 1</p>
    <p> <a href="">More information on this course.</a></p>
  </div>
</div>
      </div>

</div>

    <div id="push"></div>
    <div id="footer">
      <div class="container">
        <p class="muted credit"><?php include'footer.php';?></p>
      </div>
    </div>
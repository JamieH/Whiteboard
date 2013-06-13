<?php
include 'moodle/moodle.php';
include 'common.php';
print($_COOKIE[session_name()]);
print '<br />';
print_r($_SESSION);
print '<br />';
print_r(getMoodleDetails($_SESSION['user']['id'], $db));
?>
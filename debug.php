<?php
session_start();
include 'moodle/moodle.php';
print($_COOKIE[session_name()]);
print '<br />';
print_r($_SESSION);
?>
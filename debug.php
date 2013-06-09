<?php
session_start();
include 'moodle/moodle.php';
print($_COOKIE[session_name()]);
print '/n';
print_r($_SESSION);
?>
<?php
session_start();
print($_COOKIE[session_name()]);
print '/n';
print_r($_SESSION);
?>
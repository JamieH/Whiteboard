<?php
echo '<p>&copy;2013 All Rights Reserved<br /><em>';
echo shell_exec("git log -1 --pretty=format:'%h - %s (%ci)' --abbrev-commit");
echo'</em></p>';
?>
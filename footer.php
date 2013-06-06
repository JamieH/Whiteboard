<?php
echo '<p>&copy;2013 All Rights Reserved - Thanks to <a href="http://rethinkvps.com">ReThinkVPS</a> for hosting us<br /><em>';
echo shell_exec("git log -2 --pretty=format:'%h - %s (%ci)' --abbrev-commit");
echo "<p style='color: white;'>" . shell_exec("git log -4 --pretty=oneline --abbrev-commit") . "</p>";
echo'</em></p>';
?>
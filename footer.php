<?php
echo '<p>&copy;2013 All Rights Reserved - Thanks to <a href="http://rethinkvps.com">ReThinkVPS</a> for hosting us<br /><em>';
echo shell_exec("git log -1 --pretty=format:'%cn - %s (%ci)' --abbrev-commit");
echo'</em></p>';
?>
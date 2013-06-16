<div id="footer">
 <div class="navbar navbar-inner  navbar-fixed-bottom">
    <p class="muted credit">
    	<p style="color: white;">
<?php
echo '&copy;2013 All Rights Reserved - Thanks to <a href="http://rethinkvps.com">ReThinkVPS</a> for hosting us<br /><em>';
echo shell_exec("git log -1 --pretty=format:'%h - %s (%ci)' --abbrev-commit");

?></p>
 </div>
</div>
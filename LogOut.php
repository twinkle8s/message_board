<?php
include_once 'Header.php';

destroySessionData();

header("refresh:1 ; url=Homepage.php");

die("<div class='content'><h2>$username, you are logged out successfully.</div></body></html>");

?>
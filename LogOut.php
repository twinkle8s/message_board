<?php
include_once 'Header.php';

destroySessionData();

header("refresh:1 ; url=Homepage.php");

die("<div class='container' style='text-align: center'><h2>$username, you are logged out successfully.</div></body></html>");

?>
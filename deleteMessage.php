<?php
include_once 'Header.php';

if (isset($_GET['title']))
{
	$title=sanitize($_GET['title']);
}
else
{
	header("refresh:1 ; url=SECRET.php");
	die("<div class='content'><h2>Sorry, we can't find this message</h2></div></body></html>");
}

queryMysql("DELETE FROM message WHERE title='$title'");

header("refresh:1 ; url=SECRET.php");
die("<div class='content'><h2>Delete successfully</h2></div></body></html>");

?>
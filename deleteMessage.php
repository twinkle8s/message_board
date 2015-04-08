<?php
include_once 'Header.php';

if (isset($_GET['title']))
{
	$title=sanitize($_GET['title']);
}
else
{
	header("refresh:1 ; url=SECRET.php");
	die("<div class='container' style='text-align: center'><h2>Sorry, we can't find this message.</h2></div></body></html>");
}

$query="DELETE FROM message WHERE title='$title'";
$connect->query($query);

header("refresh:1 ; url=SECRET.php");
die("<div class='container' style='text-align: center'><h2>Delete successfully</h2></div></body></html>");

?>
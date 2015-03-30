<?php
include_once "Header.php";

if (isset($_POST['title']))
{
	$name=$username;
	$title=sanitize($_POST['title']);
	$content=sanitize($_POST['content']);

	if ($title=="" || $content=="")
	{
		$error="*Not all fields were entered";
	}
	elseif (mysql_num_rows(queryMysql("SELECT * FROM message WHERE title='$title' AND type='main'")))
	{
		$error="*Sorry, that title name already exists";
	}
	else
	{
		queryMysql("INSERT INTO message (name, title, content, type, time) 
			VALUES('$name', '$title', '$content', 'main', NULL)");
	}
}

?>
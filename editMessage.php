<?php
include_once 'Header.php';

if (isset($_GET['title']))
{
	$title=sanitize($_GET['title']);
}
else
{
	header("refresh:1 ; url=http://localhost/SECRET.php");

	die("<div class='content'><h2>Sorry, we can't find this message</h2></div></body></html>");
}

$error="";

$query=queryMysql("SELECT * FROM message WHERE title='$title' AND type='main'");
$result=mysql_fetch_row($query);

if (isset($_POST['title']))
{
	$title=sanitize($_POST['title']);
	$content=sanitize($_POST['content']);

	if ($title=="" || $content=="")
	{
		$error="Not all fields were entered";
	}
	elseif ($title!=$result[2] && mysql_num_rows($query))
	{
		$error="Sorry, that title name already exists";
	}
	else
	{
		if ($title!=$result[2])
		{
			queryMysql("UPDATE message SET title='$title' WHERE title='$result[2]' AND type='main'");
		}

		if ($content!=$result[3])
		{
			queryMysql("UPDATE message SET content='$content' WHERE content='$result[3]' AND type='main'");
		}

		header("refresh:1 ; url=http://localhost/Message.php?title=$title");

		die("<div class='content'><h2>Edit successfully</h2></div></body></html>");
	}
}

?>

<div class='content'><h2>Edit Message</h2>
<form method="POST" action="">
<span class='error'><?php echo $error ?></span>
<br>
<span>Name: <?php echo $username ?></span>
<br>
<span>Title: </span>
<input type='text' name='title' value="<?php echo $result[2] ?>" maxlength='30' autofocus>
<br>
<span>Content: </span>
<textarea name='content' rows='10' cols='30' maxlength='300'><?php echo $result[3] ?></textarea>
<br>
<span class='button'><input type='submit' value='Edit'></span></div>

</form></div></body></html>
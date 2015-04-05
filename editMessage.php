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

$error="";

$query=queryMysql("SELECT * FROM message WHERE title='$title' AND type='main'");
$result=mysql_fetch_row($query);

if (isset($_POST['title']))
{
	$title=sanitize($_POST['title']);
	$content=sanitize($_POST['content']);

	$q=queryMysql("SELECT * FROM message WHERE title='$title' AND type='main'");

	if ($title=="" || $content=="")
	{
		$error="Not all fields were entered";
	}
	elseif ($title!=$result[2] && mysql_num_rows($q))
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

		header("refresh:1 ; url=Message.php?title=$title");

		die("<div class='container' style='text-align: center'><h2>Edit successfully</h2></div></body></html>");
	}
}

?>

<div class='container' style="margin: 0% 30%; width: 40%"><h2>Edit Message</h2></div>
<form class="form-horizontal" style="margin: 0% 32%; width: 36%" method="POST" action="">
	<div class="form-group">
		<label class="control-label col-sm-2" for="name">Name:</label>
		<div class="col-sm-8">
			<p class="form-control-static"><?php echo $username ?></p>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="title">Title:</label>
		<div class="col-sm-8">
			<input type='text' class="form-control" name='title' value="<?php echo $result[2] ?>" maxlength='30' autofocus>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="content">Content:</label>
		<div class="col-sm-8">
			<textarea class="form-control" name='content' rows='10' cols='30' maxlength='300'><?php echo $result[3] ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<input type='submit' class="btn btn-default" value='Edit'>
			<span id='error'><?php echo $error ?></span>
		</div>
	</div>
</form>
</body></html>
<?php
include_once 'Header.php';

echo "<div class='content'><h2>LOVE SECRET</h2>";

$error="";

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

$query=queryMysql("SELECT * FROM message WHERE type='main'");
$rows=mysql_num_rows($query);

echo <<<_END
<table>
  <tr>
    <th>Name</th>
    <th>Title</th>
    <th>Date</th>
    <th colspan='3'></th>
  </tr>
_END;

for ($i=0; $i<$rows; $i++)
{
	$row=mysql_fetch_row($query);
	$row[5]=date("Y/m/d", strtotime($row[5]));

	echo "<tr>" .
		"<td>$row[1]</td>" .
		"<td>$row[2]</td>" .
		"<td>$row[5]</td>";

	if ($row[1]==$username)
	{
		echo "<td><a class='ahref' href='Message.php?title=$row[2]'>Show</a></td>" .
			"<td><a class='ahref' href='editMessage.php?title=$row[2]'>Edit</a></td>" .
			"<td><a class='ahref' href='deleteMessage.php?title=$row[2]'>Delete</a></td></tr>";
	}
	else
	{
		echo "<td><a class='ahref' href='Message.php?title=$row[2]'>Show</a></td></tr>";
	}
}

?>

</table>

<form method='POST' action=''>
<fieldset>
<legend>Post Message</legend>
<span class='error'><?php echo $error ?></span>
<br>
<span>Name: <?php echo $username?></span>
<br>
<span>Title: </span>
<input type='text' id='title' name='title' maxlength='30' autofocus>
<br>
<span>Content: </span>
<textarea name='content' rows='10' cols='30' maxlength='300'></textarea>
<br>
<span class='button'><input type='submit' id='post' value='Post'></span></fieldset>

<script src="jquery-2.1.3.min.js"></script>
<script src="message_board.js"></script>

</form></div></body></html>
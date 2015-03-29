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

if (isset($_POST['userReply']))
{
	$name=$username;
	$userReply=sanitize($_POST['userReply']);

	if ($userReply=="")
	{
		$error="*Not all fields were entered";
	}
	else
	{
		queryMysql("INSERT INTO message (name, title, content, type, time)
		 VALUES('$name', '$title', '$userReply', 'reply', NULL)");
	}
}

$query=queryMysql("SELECT * FROM message WHERE title='$title' AND type='main'");
$main=mysql_fetch_row($query);
$main[5]=date("Y/m/d", strtotime($main[5]));

$query=queryMysql("SELECT * FROM message WHERE title='$title' AND type='reply'");
$rows=mysql_num_rows($query);

?>

<div class='content'>
<table>
  <tr>
    <th>Name</th>
    <td><?php echo $main[1] ?></td>
  </tr>
  <tr>
    <th>Title</th>
    <td><?php echo $main[2] ?></td>
  </tr>
  <tr>
    <th>Content</th>
    <td><?php echo $main[3] ?></td>
  </tr>
  <tr>
    <th colspan='1'></th>
    <td><?php echo $main[5] ?></td>
  </tr>
  <tr>
    <th colspan='1'></th>

<?php

if ($main[0]==$username)
{
    echo "<td><a class='ahref' href='editMessage.php?title=<?php echo $main[2] ?>'>Edit</a>" .
        "<a class='ahref' href='deleteMessage.php?title=<?php echo $main[2] ?>'>Delete</a></td>";
}

echo "</tr>" .
  	"<tr><th>Reply</th><td>";

for ($i=0; $i<$rows; $i++)
{
	$reply=mysql_fetch_row($query);
	$reply[5]=date("Y/m/d", strtotime($reply[5]));

	echo "<span>$reply[1]</span>" .
		"<span> : $reply[3]</span>" .
		"<span>$reply[5]</span><br>";
}

?>

</td></tr></table></div>

<div id='reply'>
<form method='POST' action=''>
<span><?php echo $username ?></span>
<span><input type='text' name='userReply' maxlength='30'></span>
<span><input type='submit' value='Reply'></span>
<br>
<span class='error'><?php echo $error ?></span>

</form></div></body></html>
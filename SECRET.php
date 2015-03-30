<?php
include_once 'Header.php';

echo "<div class='content'><h2>LOVE SECRET</h2>";

$error="";

$query=queryMysql("SELECT * FROM message WHERE type='main'");
$rows=mysql_num_rows($query);

?>

<script type='text/javascrpt' src="jquery-2.1.3.min.js"></script>
	<script type='text/javascrpt' src="message_board.js"></script>

<table id='table1'>
  <tr>
    <th>Name</th>
    <th>Title</th>
    <th>Date</th>
    <th colspan='3'></th>
  </tr>

<?php

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
<span id='error1'></span>
<br>
<span>Name: <?php echo $username?></span>
<input type='hidden' id='username' name='username' value='<?php $username ?>'>
<br>
<span>Title: </span>
<input type='text' id='title' name='title' maxlength='30' autofocus>
<br>
<span>Content: </span>
<textarea name='content' rows='10' cols='30' maxlength='300'></textarea>
<br>
<span class='button'><input type='submit' id='post' value='Post'></span></fieldset>

</form></div></body></html>
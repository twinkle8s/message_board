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

$query="SELECT * FROM message WHERE title='$title' AND type='main'";
$result=$connect->query($query);
$main=$result->fetch_row();
$main[5]=date("Y/m/d", strtotime($main[5]));

$query="SELECT * FROM message WHERE title='$title' AND type='reply'";
$result=$connect->query($query);
$rows=$result->num_rows;
?>

<div class="container" style="margin: 0% 30%; width: 40%"><h2>Main</h2>

<script src="message_reply.js"></script>

<table class="table">
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
    <th>Create Time</th>
    <td><?php echo $main[5] ?></td>
  </tr>

<?php
if ($main[1]==$username)
{
    echo "<tr><td colspan='1'></td><td>" .
        "<a href='editMessage.php?title=$main[2]'>Edit</a>" .
        "&nbsp;&nbsp;&nbsp" .
        "<a href='deleteMessage.php?title=$main[2]'> Delete</a></td></tr>";
}
?>

</table>
<h2>Reply</h2>
<table id="reply" class="table">
  <thead>
    <th>Name</th>
    <th>Reply</th>
    <th>Time</th>
  </thead>

<?php
for ($i=0; $i<$rows; $i++)
{
	$reply=$result->fetch_row();
	$reply[5]=date("Y/m/d", strtotime($reply[5]));

	echo "<tr><td>$reply[1]</td>" .
		"<td>$reply[3]</td>" .
		"<td>$reply[5]</td></tr>";
}
?>

</table></div>

<div class="container" style="margin: 0% 32%; width: 36%">
<form class="form-inline" method='POST' action=''>
  <div class="form-group">
    <label for="name"><?php echo $username ?></label>
    <input type='hidden' id='username' name='username' value='<?= $username ?>'>
    <input type='hidden' id='title' name='title' value='<?= $title ?>'>
    <input type='text' id='userReply' class="form-comtrol" name='userReply' maxlength='30'>
  </div>
  <input class="btn btn-default" type='submit' value='Reply'>

<span id='error'></span>

</form></div></body></html>
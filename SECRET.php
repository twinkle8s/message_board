<?php
include_once 'Header.php';
?>

<div class='container'><h2>LOVE SECRET</h2>

<script src="message_board.js"></script>

<table class="table">
<thead>
  <tr>
    <th>Name</th>
    <th>Title</th>
    <th>Date</th>
    <th colspan='3'></th>
  </tr>
</thead>
<tbody>

<?php
$query="SELECT * FROM message WHERE type='main'";
$result=$connect->query($query);
$rows=$result->num_rows;

for ($i=0; $i<$rows; $i++)
{
	$row=$result->fetch_row();
	$row[5]=date("Y/m/d", strtotime($row[5]));

	echo "<tr>" .
		"<td>$row[1]</td>" .
		"<td>$row[2]</td>" .
		"<td>$row[5]</td>";

	if ($row[1]==$username)
	{
		echo "<td><a href='Message.php?title=$row[2]'>Show</a></td>" .
			"<td><a href='editMessage.php?title=$row[2]'>Edit</a></td>" .
			"<td><a href='deleteMessage.php?title=$row[2]'>Delete</a></td></tr>";
	}
	else
	{
		echo "<td><a href='Message.php?title=$row[2]'>Show</a></td>" .
			"<td colspan='2'></td</tr>";
	}
}
?>

</tbody></table></div>

<div class="container"><h2>Post Message</h2>
<form id='post' class="form-horizontal" method='POST' action=''>
	<div class="form-group">
		<label class="control-label col-sm-2" for="name">Name:</label>
		<div class="col-sm-6">
			<p class="form-control-static"><?php echo $username?>
			<input type='hidden' id='username' name='username' value="<?= $username ?>"></p>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="title">Title:</label>
		<div class="col-sm-6">
			<input type='text' id='title' class="form-control" name='title' maxlength='30'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="content">Content:</label>
		<div class="col-sm-6">
			<textarea id='content' class="form-control" name='content' rows='5' maxlength='300'></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<input type='submit' class="btn btn-default" value='Post'>
			<span id='error'></span>
		</div>
	</div>
</form>
</div>
</body></html>
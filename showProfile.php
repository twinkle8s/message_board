<?php
include_once 'Header.php';

$query=queryMysql("SELECT * FROM profile WHERE username='$username'");
$row=mysql_fetch_row($query);

$row[6]=date("Y/m/d H:i", strtotime($row[6]));
$row[7]=date("Y/m/d H:i", strtotime($row[7]));

?>

<div class="container" style="margin-left: 30%"><h2>Profile</h2>
<table class="table" style="width: 50%">
  <tr>
  	<th>Username</th>
  	<td><?php echo $row[0] ?></td>
  </tr>
  <tr>
  	<th>Gender</th>
  	<td><?php echo $row[1] ?></td>
  </tr>
  <tr>
  	<th>Birthday</th>
  	<td><?php echo $row[2] ?></td>
  </tr>
  <tr>
  	<th>Phone Number</th>
  	<td><?php echo $row[3] ?></td>
  </tr>
  <tr>
  	<th>E-mail</th>
  	<td><?php echo $row[4] ?></td>
  </tr>
  <tr>
  	<th>Address</th>
  	<td><?php echo $row[5] ?></td>
  </tr>
  <tr>
  	<th>Create Time</th>
  	<td><?php echo $row[6] ?></td>
  </tr>
  <tr>
  	<th>Update Time</th>
  	<td><?php echo $row[7] ?></td>
  </tr>
</table>

  <input type='button' class="btn btn-default" value='Edit' onclick="location.href='editProfile.php'">
  <input type='button' class="btn btn-default" value='Change Password' onclick="location.href='changePW.php'">
</div></body></html>
<?php
include_once 'Header.php';

$query=queryMysql("SELECT * FROM profile WHERE username='$username'");
$row=mysql_fetch_row($query);

$row[6]=date("Y/m/d H:i", strtotime($row[6]));
$row[7]=date("Y/m/d H:i", strtotime($row[7]));

?>

<div class='content'><h2>Profile</h2>
<table>
  <tr>
  	<td>Username</td>
  	<td><?php echo $row[0] ?></td>
  </tr>
  <tr>
  	<td>Gender</td>
  	<td><?php echo $row[1] ?></td>
  </tr>
  <tr>
  	<td>Birthday</td>
  	<td><?php echo $row[2] ?></td>
  </tr>
  <tr>
  	<td>Phone Number</td>
  	<td><?php echo $row[3] ?></td>
  </tr>
  <tr>
  	<td>E-mail</td>
  	<td><?php echo $row[4] ?></td>
  </tr>
  <tr>
  	<td>Address</td>
  	<td><?php echo $row[5] ?></td>
  </tr>
  <tr>
  	<td>Create Time</td>
  	<td><?php echo $row[6] ?></td>
  </tr>
  <tr>
  	<td>Update Time</td>
  	<td><?php echo $row[7] ?></td>
  </tr>
</table>

<span id='edit'><input type='button' value='Edit' onclick="location.href='editProfile.php'"></sapn>
<span id='changePW'><input type='button' value='Change Password' onclick="location.href='changePW.php'"></span>
</div></body></html>
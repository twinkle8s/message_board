<?php
include_once "editProfile_mysqli.php";
?>

<div class='container' style="margin: 0% 32%; width: 36%"><h2>Edit profile</h2></div>
<form class="form-horizontal" style="margin: 0% 30%; width: 40%" method='POST' action='editProfile.php'>
	<div class="form-group">
		<label class="control-label col-sm-4" for="username">* Username</label>
		<div class="col-sm-8">
			<input type='text' class="form-control" name='username' value='<?php echo $row[0] ?>' pattern="[a-zA-Z0-9]{1,16}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="gender">Gender</label>
		<div class="radio col-sm-8">
			<label><input type='radio' name='gender' value='male'>Male</label>
			<label><input type='radio' name='gender' value='female'>Female</label>
			<label><input type='radio' name='gender' value='' checked='checked'>None</label>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="birthdate">Birthday</label>
		<div class="col-sm-4">
			<input type='date' class="form-control" name='birthdate' value='<?php echo $row[2] ?>'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="phone">Phone Number</label>
		<div class="col-sm-8">
			<input type='text' class="form-control" name='phone' value='<?php echo $row[3] ?>' pattern="[0-9]{9,10}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="email">E-mail</label>
		<div class="col-sm-8">
			<input type='email' class="form-control" name='email' value='<?php echo $row[4] ?>' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="address">Address</label>
		<div class="col-sm-8">
			<input type='text' class="form-control" name='address' value='<?php echo $row[5] ?>' maxlength='80'>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type='submit' class="btn btn-default" value='Confirm'>
			<span id="error"><?php echo $error ?></span>
</form>
</body></html>
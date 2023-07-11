<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body> 
	<div class="kotak_login">
		<p class="tulisan_login">Login Admin</p>
 
		<form action="index.php">
			<label>Username</label>
			<input type="text" name="username" class="form_login" placeholder="Username">
 
			<label>Password</label>
			<input type="text" name="password" class="form_login" placeholder="Password">
 
			<input type="submit" class="tombol_login" value="LOGIN">
		</form>
		
	</div>
 
 
</body>
</html>




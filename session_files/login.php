<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="beauty.css">
</head>
<body>
  <div class="header">
  	<h2>Sign in</h2>
  </div>
<!--/*The PHP superglobals $_GET and $_POST are used to collect form-data.-->	 
  <form method="post" action="login.php">
  <?php include('wrong.php'); ?>
  	<div class="input-group">
  		<label>Username</label>			<!--The <label> element does not render as anything special for the user. However, it provides a usability improvement for mouse users, because if the user clicks on the text within the <label> element, it toggles the control.-->
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
	
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Sign in</button>
  	</div>
	
  	<p>
  		Not enrolled yet? <a href="signup.php">Sign up</a>
  	</p>
  </form>
</body>
</html>
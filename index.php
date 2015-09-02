<?php
	session_start();
	if(isset($_SESSION['sno']))
	{
		header('Location: stu568.php');
	}
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    
    
    
    
        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

<body>
<div style="position:absolute;margin-right:10px;margin-top:10px;right:10px;">
    <span href="#" class="button" id="toggle-login">Log in</span>
	<div id="login">
	<div id="triangle"></div>
	<h1>Log in</h1>
	<form action="login.php" method="post">
		<input type="text" placeholder="UserName" name="uname" id="uname"/>
		<input type="password" placeholder="Password" name="pass" id="pass"/>
		<span id="warning" style="color:red;margin:3px;display:none"></span>
		<input type="submit" value="Log in" />
	</form>
	</div>
</div>
    <script src='js/jquery.js'></script>

        <script src="js/index.js"></script>

    
    
    
  </body>
</html>

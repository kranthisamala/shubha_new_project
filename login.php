<?php
	require 'minimum_log.php';
	if(isset($_POST['uname'])&&isset($_POST['pass']))
	{
		$uname=$_POST['uname'];
		$pass=$_POST['pass'];
		$query="SELECT * FROM login_details WHERE id='$uname' AND password='$pass'";
		if($res=mysql_query($query))
		{
				if($row=mysql_num_rows($res))
				{
					ob_start();
					session_start();
					$res1=mysql_fetch_assoc($res);
					$_SESSION['sno']=$res1['sno'];
					header('Location: stu568.php');
				}
				else
				{
					echo "<div style='color:red;margin:auto;width:500px;position:relative;font-size:50px;'>Wrong password and ID</div>";
				}
		}
		else
		{
			echo "<div style='color:red;width:500px;margin:auto;position:relative;font-size:50px;'>Wrong password and ID</div>";
		}	
	}
?>
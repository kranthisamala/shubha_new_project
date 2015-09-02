<?php
include 'minimum_log.php';
session_start();
$sno=$_SESSION['sno'];
	if(isset($_POST['post_submit'])&&!empty($_POST['post_submit']))
	{	
		if($from=mysql_query("SELECT * FROM login_details WHERE sno='$sno'"))
		{
			$name=mysql_fetch_assoc($from);
			$from=$name['id'];
			$image="";
			$text="";
			if(isset($_FILES['post_file'])&&!empty($_FILES['post_file']['tmp_name']))
			{
				$file=$_FILES['post_file']['tmp_name'];
				$image=addslashes(file_get_contents($_FILES['post_file']['tmp_name']));
				$image_name=$_FILES['post_file']['name'];
				$image_size=getimagesize($_FILES['post_file']['tmp_name']);
				if($image_size==FALSE)
					echo "that is not image";
			}
			if(isset($_POST['post_text']))
			{
				$text=$_POST['post_text'];
			}
			$query1="INSERT INTO `post`(`from`, `post`, `image`) VALUES('$from','$text','$image')";
			mysql_query($query1);
			header("location:index.php");
		}
		else{
			echo "not uploded";
		}
	}
?>
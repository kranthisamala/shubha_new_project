<?php
require 'minimum_log.php';
$image="";
if(isset($_GET['type']))
{
	if(isset($_GET['sno']))
	{
		$sno=$_GET['sno'];
		if($_GET['type']=='global_post')
		{	
			$image=mysql_fetch_assoc(mysql_query("SELECT * FROM `global_post` WHERE `sno`='$sno'"));
			$image=$image['image'];
		}
		if($_GET['type']=='post')
		{
			$image=mysql_fetch_assoc(mysql_query("SELECT * FROM `post` WHERE `sno`='$sno'"));
			$image=$image['image'];
		}
		
	}
	else if(isset($_GET['post_id']))
	{
		$sno=mysql_real_escape_string($_GET['post_id'])or die("bolo");
		$image=mysql_query("SELECT * FROM `login_details` WHERE `id`='$sno'") or die(mysql_error());
		$image=mysql_fetch_assoc($image);
		$image=$image['dp'];
	}
}
else if(isset($_GET['id']))
{
	$sno=mysql_real_escape_string($_GET['id'])or die("bolo");
	$image=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die(mysql_error());
	$image=mysql_fetch_assoc($image);
	$image=$image['dp'];
}
header("Content-type: image/jpeg");
echo $image;
?>
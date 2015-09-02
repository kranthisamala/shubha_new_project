<?php
require 'minimum_log.php';
$sno=mysql_real_escape_string($_GET['id'])or die("bolo");
$image=mysql_query("SELECT * FROM `login_details` WHERE `sno`='$sno'") or die(mysql_error());
$image=mysql_fetch_assoc($image);
$image=$image['dp'];
header("Content-type: image/jpeg");
echo $image;
?>
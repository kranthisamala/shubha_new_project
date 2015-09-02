<?php
$db_host = "localhost";
$db_username = "root";
$db_pass = "potti@1517";
$db_name = "login_test";
@mysql_connect("$db_host","$db_username","$db_pass") or die ("Problem with sql");
@mysql_select_db("$db_name") or die ("NO database");
?>
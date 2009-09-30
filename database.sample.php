<?php
$hostname = "127.0.0.1";
$database = "dms_315";
$db_username = "USERNAME";
$db_password = "PASSWORD";

$db_connect = mysql_connect($hostname, $db_username, $db_password);
$db = mysql_select_db($database);

?>

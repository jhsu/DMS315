<?php
/*
 * Sample Database.php configuration
 */

$hostname = "127.0.0.1";
$database = "world";
$db_username = "username";
$db_password = "password";

$db_connect = mysql_connect($hostname, $db_username, $db_password);
$db = mysql_select_db($database);
?>

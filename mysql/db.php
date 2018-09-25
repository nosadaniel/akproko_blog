<?php
$server_name ='localhost';
$db_user_name = 'root';
$password = '';
$db = 'akprokoblog';
$connect = new mysqli($server_name, $db_user_name, $password, $db);
if (!$connect) {
	die('Unable to database');
}


?>
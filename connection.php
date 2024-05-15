<?php
session_start();
//phpinfo(); die;



$link = mysql_connect("localhost","agentumr_andalusia_login","System@!23"); 
//$query = mysql_query($link, "CREATE DATABASE IF NOT EXISTS umrahand_andalusia_login")or die(mysql_error($link)); 
$conn = mysql_select_db("agentumr_andalusia_login",$link) or die ('Error select database: ' . mysql_error()); 
?>

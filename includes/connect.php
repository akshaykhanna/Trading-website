<?php
$connect=mysql_connect('localhost','aki','easy');
if(!$connect)
echo "Unable to connect db <br/>";

$dbs=mysql_select_db('aki');
if(!$dbs)
die("Db not selected");
?>
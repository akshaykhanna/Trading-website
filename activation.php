<?php
session_start();
include("includes/connect.php");
$msg="";
if(isset($_GET['email'])&&preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_GET['email']))
{
 $email=mysql_real_escape_string($_GET['email']);
 }
 
 if(isset($_GET['key']) && strlen($_GET['key'])==32)
  {
  $key=mysql_real_escape_string($_GET['key']);
  }
 if(isset($email) && isset($key))
 {
  $sqlS="INSERT INTO users (username,email,password)    SELECT username,email,password FROM tempusers WHERE  email='$email' AND activation='$key'  LIMIT 1";
  $resultS=mysql_query($sqlS)or exit("Unable to transfer data in users table".mysql_error());
  if($resultS)
  {
  $resultD=mysql_query("DELETE  FROM tempusers WHERE email='$email'AND activation='$key'") or die ("Failed to delete data of tempuser".mysql_error());
  header("Location: prompt.php?&x=2");
  }
  else
  header("Location: prompt.php?&x=3");
 }
 else
 /*$msg="<br/> Unable to activate your account, try again later. ";
 echo $msg;*/
 header("Location: prompt.php?&x=3");
?>
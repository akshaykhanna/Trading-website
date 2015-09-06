<?php
session_start();
include("includes/connect.php");
include("includes/functions.php");
function prompt_msg($x)
{
 switch($x)
 {
 case 1:
 echo "A confirmation mail has been sent to your email account, click it to activate your account. For any asistance feel free to connect us at <br/>helpdesk@therade.com";
 break;
 case 2:
 echo "Registeration completed ! Now you can login to continue";
 break;
 case 3:
 echo "Unable to activate your account, try again later.";
 break;
 default:
 echo "Sorry, no prompt message to display";
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register</title>
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/prompt.css" />
<body>
<div id="wrapper">
<?php
headerSearch();
?>
<div id="outer">
<div id="inner">
<?php 
$x=$_GET['x'];
prompt_msg($x) ?>
</div>
</div>
</div>
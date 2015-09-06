<?php
session_start();
include("includes/connect.php");
include("includes/functions.php");
//intialising variables
$error="";
$username="";
$pass="";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/form.css"/>
<link rel="stylesheet" href="css/login.css"/>
</head>
<body>
<div id="wrapper">
<?php
headerSearch();
?>
  <aside id="left_side">
    <img src="images/registerbanner.png"  />
  </aside>
  <section id="right_side">
    <form method="post" action="" id="generalform" class="container">
	 <h3>Login</h3>
	 <?php  
	    if($error!="")
		echo " <div class='error'>$error</div>"; 
		?>
	<div class="field">
	    <label for="username">Username</label> &nbsp <input class="input" type="text" name="username" maxlength="20" id="username" value="<?php echo $username; ?>"/>
	    <p class="hint">Alphanumeric(a-z, A-Z, 0-9) & 20 charcters maximum</p>
		</div>
		<div class="field">
		<label for="password">Password</label>&nbsp <input class="input" type="password" name="pass"  maxlength="20" id="pass" value="<?php echo $pass; ?>" />
	    <p class="hint">20 charcters maximum and minimum 5 characters</p>
		</div>
		<div class="field">
	      <input type="submit" name="submit" id="submit" class="button" value="Submit"/> 
		  </div>
       <form>
  </section>
</div>
</body>
</html>
<?php
session_start();
include("includes/connect.php");
include("includes/functions.php");
//intialising variables
$error="";
$username="";
$pass="";
$email="";
if(isset($_POST['submit']))
   {
   //username
    if(!empty($_POST['username']))
	 {
	  if(ctype_alnum($_POST['username']))
	    {
		 if(duplicate($_POST['username']))
           {
            $username=htmlentities($_POST['username']);
			}
          else 
     		$error.="Sorry, username allready occupied. ";  
		}
	   else
	   $error.="Username must be alphanumeric. ";
	  }
	else
	$error.="Please enter username. ";
	
	//password
	if(!empty($_POST['pass']))
	 {
	  if(!empty($_POST['c_pass']))
	    {
		 if($_POST['pass']==$_POST['c_pass'])
		  {
		   $pass=mysql_real_escape_string($_POST['pass']);
		  }
		  else
		  $error.="Passwords do not match";
		}
		else  
		$error.="Enter confirm password ";
	  }
	  else
	  $error.="Enter password. ";
	  
	//email
	if(!empty($_POST['email']))
	  {
	    if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email']))
		{
          if(dup_email($_POST['email']))
		  $email=mysql_real_escape_string($_POST['email']);
		  else
		  $error.="A user is allready registered from this Email. "; 
		  }
		  else
		  $error.="Invalid email. ";
	  }
	  else
	  $error.="Enter email. ";
	
	if($error=="")
	 {
	 $pass=md5($pass);
	 $activation=md5(uniqid(rand(),true));
	  $sqldb="INSERT INTO tempusers (user_id,username,email,password,activation) Values('','$username','$email','$pass','$activation')";
	   enterDbSql($sqldb,$email,$activation);
	   }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Register</title>
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/form.css"/>
<link rel="stylesheet" href="css/register.css"/>
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
	 <h3>Register</h3>
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
		<label for="c_password">Confirm Pass</label>&nbsp <input class="input" type="password" name="c_pass"  maxlength="20" id="c_pass" value="<?php echo $pass; ?>" />
	    <p class="hint">Must match above password</p>
		</div>
		<div class="field">
		<label for="email">Email</label>&nbsp <input class="input" type="text" name="email"  maxlength="80" id="email" value="<?php echo $email; ?>" />
	    <p class="hint">Max 80 charcters and should be a valid email.</p>
		</div>
		<div class="field">
	      <input type="submit" name="submit" id="submit" class="button" value="Submit"/> 
		  </div>
       <form>
  </section>
</div>
</body>
</html>
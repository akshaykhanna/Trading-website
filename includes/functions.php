<?php
  
  // default search text from search sesion 
  
  function headerSearch()
  {
$default = htmlentities($_GET['keywords']);
echo ' <header id="main_header">
           <div id="rightAlign">
		  ';
			//dynamic links here
			dynamicLinks();
		echo ' </div>
		      <a href="index.php"><img src="images/therade.png" height="70px" width="300px" /></a>
			  </header>
			  ';
			   //search boxes
			  echo " <nav id=\"top_search\">
                <form mehtod=\"get\"	action=\"search.php\" name=\"inputs\" >		       
				   <input type=\"text\" size=\"100\" name=\"keywords\" class='searchBox' id=\"keywords\" value='$default' />
				   &nbsp "
					;
					// Search drop down menu
					echo " <select id='category' name='category' class='searchBox'>";
					searchCategories();
					
               echo " </select>
			   <input type='submit' class='button' value='Search' />
		                </form>
						</nav>
						";
   }
   
   
   
   function searchCategories()
   {
     
	 if(ctype_digit($_GET['category']))
	    $x=$_GET['category'];
		else
		   $x=999; 
		   echo "<option value='-1'> All categories </option>";
	   $i=0;
	   while(1)
	   {
	   if(numberToCategory($i)=="Category Does Not Exist")
	   break;
	   echo "<option value='$i' ";
	   if($i==$x)
	   echo "SELECTED ";
	    echo ">". numberToCategory($i) ."</option>";  
	   $i++;
     
	 }
	}
			
//Category N umber to String
function numberToCategory($n){
	switch($n){
    case 0:
        $cat = "Buildings";
        break;
    case 1:
        $cat = "Cartoon";
        break;
    case 2:
        $cat = "Nature";
        break;
		/*
	case 3:
        $cat = "Baby";
        break;
	case 4:
        $cat = "Books";
        break;
	case 5:
        $cat = "Business & Industrial";
        break;
	case 6:
        $cat = "Cameras & Photo";
        break;
	case 7:
        $cat = "Clothing & Accessories";
        break;
	case 8:
        $cat = "Collectibles";
        break;
	case 9:
        $cat = "Computers";
        break;
	case 10:
        $cat = "Crafts";
        break;
	case 11:
        $cat = "DVD's & Movies";
        break;
    case 12:
        $cat = "Electronics";
        break;
	case 13:
        $cat = "Health & Beauty";
        break;
	case 14:
        $cat = "Home & Garden";
        break;
	case 15:
        $cat = "Jewelry & Watches";
        break;
	case 16:
        $cat = "Music";
        break;
	case 17:
        $cat = "Pet Supplies";
        break;
	case 18:
        $cat = "Services";
        break;
	case 19:
        $cat = "Sports & Outdoors";
        break;
	case 20:
        $cat = "Sports Memorabilia & Cards";
        break;
	case 21:
        $cat = "Tools & Home Improvement";
        break;
    case 22:
        $cat = "Toys & Hobbies";
        break;
	case 23:
        $cat = "Video Games";
        break;
	case 24:
        $cat = "Other";
        break;*/
	default:
        $cat = "Category Does Not Exist";
	}
	
	return $cat;
}

	// header right top links		
   function dynamicLinks()
   { 

    if(!isset($x))
	{ 
	  echo " <div id='rightAlign'> <a href='register.php'> Register</a> | 
    <a href='login.php'>Login</a> &nbsp </div> ";
	}
	else 
	{
	  //For Message(no. of unread message)

	  $sql1= "SELECT * FROM messages WHERE receiver=$x AND status='unread' ";
	  $result1=mysql_query($sql1)or die('Unable to select db'.mysql_error());
	  $num1=mysql_num_rows($result1);
	  
	  if($num1==0)
	  echo "<a href='message_inbox.php'/> Messages | </a>";
	  else
	  echo "<a href='message_inbox.php'/> Messages($num1) | </a>";
	  
	   echo "<a href='add_item.php'/> Add Item | </a>";
      echo " <a href='settings.php'/> Settings | </a>"; 
	  echo " <a href='logout.php'/> Logout &nbsp</a>" ; 
	  
	}//end of else
   }// end of function
  
    // check for duplicate username
  function duplicate($user)	
	{
	 $sqld="SELECT username FROM users WHERE username='$user'";
	 $resultd=mysql_query($sqld) or die("<br/>Unable to select from users table");
	 $numd=mysql_num_rows($resultd);
	 $sqldt="SELECT username FROM tempusers WHERE username='$user'";
	 $resultdt=mysql_query($sqldt) or die("<br/>Unable to select from tempusers table");
	 $numdt=mysql_num_rows($resultdt);
	 if($numd==0&&$numdt==0)
	 return true;
	 else 
	 return false;
	 }
	 
	 // check for duplicate email
	 function dup_email($email) 
      {
        $sqlE="SELECT email FROM users WHERE email='$email'";
         $resultE=mysql_query($sqlE) or die("<br/>Unable to select from users table");	
         $numE=mysql_num_rows($resultE);
		 $sqlEt="SELECT email FROM tempusers WHERE email='$email'";
         $resultEt=mysql_query($sqlEt) or die("<br/>Unable to select from tempusers table");	
         $numEt=mysql_num_rows($resultEt);
        if($numE==0&&$numEt==0)
	   return true;
	    else 
	   return false;
	 }
	  		 
	 //enter user registeration details in db
	 function enterDbSql($sqldb,$email,$a)
	 {
	  $resultdb=mysql_query($sqldb) or die("<br/> Failed to enter your details in DB, try again later");
	 if($resultdb)
	 {
	 $message="To confirm your registeration for THERADE.com please click the link below : \n \n";
	 $message.='http://localhost/trading/activation.php?email='.urlencode($email)."&key=$a";
	 mail($email,'Registeration confirmation',$message);
	 header("Location: prompt.php?&x=1");
	 /*
	 echo "<script type='text/javascript'>
	        function updated()
			{
			var form=document.getElementById('generalform');
			form.innerHTML='<h3>A confirmation mail is been sent to your email. Confirm via it to activate your account.</h3>';
			}
			window.addEventListener('load',updated,false);

			</script>";*/
		}	
	
	         
	  }

function side_cat()
 {
 echo '<div id="links_box">';
 if(!isset($_GET['y']))
	$y=-1;
	else
	$y=$_GET['y'];
	page_link($y); 
  echo " </div>";
 } 
function page_link($y)
{
if(($y==-1))
echo "<div id='selected_link'><a href='index.php?y=-1'> All categories</a></div>";
else
echo "<div id='page_link'><a href='index.php?y=-1'> All categories</a></div>";
$i=0;
 while(1)
  {
   	   if(numberToCategory($i)=="Category Does Not Exist")
	   break;
	   if($i!=$y)
	   echo "<div id='page_link'><a href='index.php?y=$i'>".numberToCategory($i)."</a></div>";
	   else
	   echo "<div id='selected_link'><a href='index.php?y=$i'>".numberToCategory($i)."</a></div>";
	   $i++;
	   }
	   }
	
function  display_items($sqlDis)
  {
   $resultT=mysql_query("$sqlDis") or exit("Error in reading from db 101".mysql_error());
   if ($resultT)
   { 
    while($rowT=mysql_fetch_array($resultT))
	 {
	  echo "<div id='item_box'>";
	  echo "<a href='display.php?&i=$rowT[item_number]&t=1&image'><img src='$rowT[icon]' width='300px' height='200px'/></a>
	          <div class='subtitles'> <h2><a href='display.php?&i=$rowT[item_number]&t=1&image'> $rowT[title]
			   </a></h2> <br/> $rowT[subtitle] </div>
			 <div class='price'>Rs: $rowT[price]/- </div>
			 </div>";
	 }
   }
   else
   echo "Failed to select top  5 bid items from db";
}	

			?>
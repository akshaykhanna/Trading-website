<?php
session_start();
include("includes/connect.php");
include("includes/functions.php");
$item_no=$_GET['i'];
function display($item_no)
{
 $sql1="SELECT * FROM items_available WHERE item_number=$item_no LIMIT 1";
 $result1=mysql_query($sql1) or "Failed to fetch db".mysql_error();
  while($row1=mysql_fetch_array($result1))
	 {
	 echo "<div id='imagebox'>
 <a href='$row1[image_path1]'> <img src='$row1[image_path1]' width='650px' height='450px'/> </a>
   </div >";
   echo "<div id='sidebox'>
   <h1> $row1[title] </h1>
   
   <h4> $row1[subtitle] </h4>
    <p> $row1[description]</p>
	<h2> Price Rs $row1[price]/- </h2>	";
 /* if(isset($row1[status]))
  echo "<h6> $row1[status] </h6>";
  else*/
  echo "<h6> In stock </h6>";
   echo "   <form method='get' action='payment.php?&i=$item_no'>
	  <input class='button' type='submit' value='Buy' />
	  </form>
  </div>";
  
  if(isset($_GET['t']))
  {
  $temp="$row1[bids]";
  $temp=$temp+1;
  $result2=mysql_query("UPDATE `items_available` set bids=$temp WHERE `item_number`=$row1[item_number]") or "Failed to fetch db".mysql_error();
  }
} 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Therade</title>
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/form.css"/>
<link rel="stylesheet" href="css/display.css"/>
<script type="text/javascript" >
</script>
</head>
<body>
<div id="wrapper">
<?php
headerSearch();
display($_GET['i']);
?>

 
 <!--<div id="imagebox">
  <img src='images\cat\building\bridge.jpg' width='650px' height='450px'/>
   </div >
	  
  <div id='sidebox'>
   <h1> Bridge </h1>
   
   <h4> bla b teee eewrewfdf bla b teee eewrewfdf bla b teee eewrewfdf </h4>
    <p> Description .................................................................
	          .........................................................
			  ................................................................
			  ...........................</p>
	<h2> Price: Rs.500/- </h2>	
  <h6> In stock </h6>	
      <form method="get" action="payment.php?&i=$item_no">
	  <input class="button" type="submit" value="Buy" />
	  </form>
  </div>-->

</div>
</body>
</html>
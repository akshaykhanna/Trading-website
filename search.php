<?php
session_start();
include("includes/connect.php");
include("includes/functions.php");
  
  function search()
   {
   $x=$_GET['category'];
   $key=$_GET['keywords'];
   $cat="";
  if($x>-1)
   $cat="AND category='$x'";
	$sqlS="SELECT `item_number`, `title`,`subtitle`,`price`, icon FROM `items_available` WHERE MATCH(`title`,`subtitle`,`description`) AGAINST('$key') $cat";
	display_items($sqlS);
   }
   
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Therade</title>
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/form.css"/>
<link rel="stylesheet" href="css/index.css"/>
</head>
<body>
<div id="wrapper">
<?php
headerSearch();
?>
  <aside id="main_aside">
    <?php side_cat(); ?>
  </aside>
  <section id="main_section">
   <?php search();?>
    </section>
</body>
</html>
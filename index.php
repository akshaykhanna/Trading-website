<?php
session_start();
include("includes/connect.php");
include("includes/functions.php");
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
   <?php 
   $sqlDis="SELECT `item_number`, `title`,`subtitle`,`icon`,`price` FROM items_available ORDER BY bids DESC, title LIMIT 5";
   display_items($sqlDis); 
   ?>
  <!--<div id='item_box'><img src='images\cat\building\bridge.jpg' width='300px' height='200px'/>
    <div class='subtitles'> <h2><a href='display.php'> Bridge </a></h2> <br/> The bridge on river of italy </div>
	<div class="price"> Rs. 200/- </div>
  </div>
  <div id='item_box'><img src='images\cat\building\bridge.jpg' width='300px' height='200px'/>
    <div class='subtitles'> <h2><a href='display.php'> Bridge </a></h2> <br/> The bridge on river of italy </div>
	<div class="price"> Rs. 200/- </div>
  </div>
   <div id='item_box'><img src='images\cat\building\bridge.jpg' width='300px' height='200px'/>
    <div class='subtitles'> <h2><a href='display.php'> Bridge </a></h2> <br/> The bridge on river of italy </div>
	<div class="price"> Rs. 200/- </div>
  </div>-->
  </section>
</body>
</html>

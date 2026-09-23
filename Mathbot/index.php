<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Math-bot</title>
		<link rel="stylesheet" type="text/css" href="css/FHD.css">
		<link rel="stylesheet" type="text/css" href="css/HD.css">
		<link rel="stylesheet" type="text/css" href="css/ipad.css">
		<meta charset="utf-8">
		<script src='JQuery.js'></script>
		<script> 
			$(function() {

				sessionStorage.clear(); //Mke sure the sessionStorage is clear
				//Scraps from pre-users must be deleted
				window.Lang="Eng";
			});
			</script>
			
		<!-- All speech recofnition/synthesis script -->
		<script src='Voice.js'></script> 
		<script src='jquery-ui/jquery-ui.min.js'></script>
		<!--  Large decimal management script -->
		<script src='big_Master/big.js'></script>
<script>
</script>

<style>
.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: fixed;
  display: inline-block;
  border-radius: 2px;
}

.notification:hover {
  background: red;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
</style> 
	</head>
	<body>
	
<a href="οδηγίες.pdf" target="_blank" class="notification">
  <span>Info</span>
  <span class="badge">1</span>
</a>
	
	
	<div class="words" contenteditable></div>
			<div id="main">
			<!--  User buttons interface  -->
				<div id="UI" class="format">
					<div id="UI_cont">
					<?php include 'UI_buttons.php';?>
					</div>
				</div>
				<!--  User Chat Area interface  -->
				<div id="textA" class="format">

					<?php include 'chatbot/index.php';?>
				
				</div>
				<!--  User lOG-iN/Register interface  -->
				<div id="User" class="format">
					<div id="User_cont">
					<?php include 'UI_user.php';?>
						
					</div>
				</div>
				<!--  User Whiteboard interface  -->
				<div id="WhiteB" class="format">
					<div id="WhiteB_cont">
					<?php include 'WhiteBoard_API/index.php';?>
						
					</div>
				</div>
				<!--  User Rating interface  -->
				<div id="RateMe" class="format">
					<div id="Rates_cont">
					<?php include 'RateMe.php';?>
						
					</div>
				</div>
			</div>


	</body>


</html>
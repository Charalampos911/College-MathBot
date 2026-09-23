<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
	$User = filter_input(INPUT_GET, 'UserPin', FILTER_SANITIZE_URL);
	$Que1 = filter_input(INPUT_GET, 'Que1', FILTER_SANITIZE_URL);
	$Que2 = filter_input(INPUT_GET, 'Que2', FILTER_SANITIZE_URL);
	$Que3 = filter_input(INPUT_GET, 'Que3', FILTER_SANITIZE_URL);
	$Que4 = filter_input(INPUT_GET, 'Que4', FILTER_SANITIZE_URL);
	$Que5 = filter_input(INPUT_GET, 'Que5', FILTER_SANITIZE_URL);
	$Que6 = filter_input(INPUT_GET, 'Que6', FILTER_SANITIZE_URL);
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------

//Post scores according to their type
	$result = mysqli_query($con,"INSERT INTO userrates(User,Que1,Que2,Que3,Que4,Que5,Que6) values('$User','$Que1','$Que2','$Que3','$Que4','$Que5','$Que6')");          //query
	
	
	mysqli_query($con, $result);
	
	$result2 = mysqli_query($con,"UPDATE users SET Rated ='1' where Pin='$User'");          //query
	mysqli_query($con, $result2);
	
	
	/*
		$post[0]['AddType'];	
	*/ 
	echo json_encode("Rated GOOOOOD!!!"); 	
	

?>
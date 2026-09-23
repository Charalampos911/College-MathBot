<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
	$User = filter_input(INPUT_GET, 'User', FILTER_SANITIZE_URL);
	$MissCor = filter_input(INPUT_GET, 'MissCor', FILTER_SANITIZE_URL);
	$Day = filter_input(INPUT_GET, 'day', FILTER_SANITIZE_URL);
	$Month = filter_input(INPUT_GET, 'month', FILTER_SANITIZE_URL);
	$Year = filter_input(INPUT_GET, 'year', FILTER_SANITIZE_URL);

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  
//Set for the first time, every user misstake when made during use of the chatbot
	$result = mysqli_query($con,"INSERT INTO stats(MissCor,User,day,month,year) values('$MissCor','$User','$Day','$Month','$Year')");          //query
	mysqli_query($con, $result);
	/*
		$post[0]['AddType'];	
	*/ 
	echo json_encode($User); 

?>
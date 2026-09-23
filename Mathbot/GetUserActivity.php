<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
	$pin = filter_input(INPUT_GET, 'UserPin', FILTER_SANITIZE_URL);
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  
  //Perform the actual log-in for the user
  $result = mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin' ");          //query
	$post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
	/*
		$post[0]['AddType'];	
	*/ 
	echo json_encode($post);	
?>
<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
	$pin = filter_input(INPUT_GET, 'pin', FILTER_SANITIZE_URL);
	$nick = filter_input(INPUT_GET, 'nick', FILTER_SANITIZE_URL);
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  
  // Register the new user
  $result = mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin' ");          //query
	$post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
  if(sizeOf($post)==0){ //NEW
  
	$result = mysqli_query($con,"INSERT INTO users(Pin,Nick) values('$pin','$nick')");          //query
	mysqli_query($con, $result);
	/*
		$post[0]['AddType'];	
	*/ 
	echo json_encode($result); 
  }else{
	//PIN is taken
	  echo json_encode(false); //Case PIN already in use! -006
  }
?>
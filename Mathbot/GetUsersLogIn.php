<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
	$pin = filter_input(INPUT_GET, 'pin', FILTER_SANITIZE_URL);
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  //Get user information
  $result = mysqli_query($con,"SELECT * FROM users WHERE Pin='$pin'");          //query
    $post = array();
	$answer = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
	if (empty($post)) {
		// list is empty.
		echo json_encode(false);
		
	}else{
		//Create new-composit array Oassing to it the newly fetchs information
		//along the old-info used to get the new from database 
		array_push($answer,"".$pin);
		array_push($answer,"".$post[0]['Nick']);
		array_push($answer,"".$post[0]['Score']);
		echo json_encode($answer);
	}
	 

	/*
		$post[0]['AddType'];	
	*/                        
?>
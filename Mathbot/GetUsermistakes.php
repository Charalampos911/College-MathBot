<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------  
	$pin = filter_input(INPUT_GET, 'UserPin', FILTER_SANITIZE_URL);
	
	//Get from the databese the userMistakes and later present them to the user
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysqli_query($con,"SELECT * FROM usermisstakes WHERE MissUser=$pin");          //query
    $post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row; 
	}
	
	/*
		$post_1[0]['v1'];	
		$post_1[0]['v2'];	
	*/ 

	
	
	

  //fetch result    
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($post);

?>
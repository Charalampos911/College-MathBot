<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------  
	//Get the numbers that convert symbols and idols to something else,
	//Used in operators and speech recognition re-transformtion



  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysqli_query($con,"SELECT * FROM transnumbers");          //query
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
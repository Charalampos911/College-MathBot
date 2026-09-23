<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
	$NumA = filter_input(INPUT_GET, 'NumA', FILTER_SANITIZE_URL);
	$Oper = filter_input(INPUT_GET, 'Oper', FILTER_SANITIZE_URL);
	$NumB = filter_input(INPUT_GET, 'NumB', FILTER_SANITIZE_URL);
	$MissUser = filter_input(INPUT_GET, 'MissUser', FILTER_SANITIZE_URL);
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  
//Set for the first time, every user misstake when made during use of the chatbot
	$result = mysqli_query($con,"INSERT INTO usermisstakes(NumA,Oper,NumB,MissUser) values('$NumA','$Oper','$NumB','$MissUser')");          //query
	mysqli_query($con, $result);
	/*
		$post[0]['AddType'];	
	*/ 
	echo json_encode(true); 

?>
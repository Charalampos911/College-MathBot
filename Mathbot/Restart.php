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
  
  // Register the new user
	$result = mysqli_query($con,"DELETE FROM usermisstakes WHERE MissUser='$pin'");          //query
	mysqli_query($con, $result);//   ,
	//$result2 = mysqli_query($con,"UPDATE users SET ScorePlus = '0',SET ScoreMinus = '0',SET ScoreMulty = '0',SET ScoreDivy = '0' WHERE Pin='$pin'");          //query
	//mysqli_query($con, $result2);
	
	//UPDATE users SET ScorePlus = '0',SET ScoreMinus = '0',SET ScoreMulty = '0',SET ScoreDivy = '0' WHERE Pin='$pin'"
	mysqli_query($con, "UPDATE users SET ScorePlus = '0' WHERE Pin='$pin'" );
	mysqli_query($con, "UPDATE users SET ScoreMinus = '0' WHERE Pin='$pin'");
	mysqli_query($con, "UPDATE users SET ScoreMulty = '0' WHERE Pin='$pin'");
	mysqli_query($con, "UPDATE users SET ScoreDivy = '0' WHERE Pin='$pin'");
	
	
	
	//$post = array();
	/*while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}*/

	echo json_encode("HAHA33"); 

?>
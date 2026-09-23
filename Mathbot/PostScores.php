<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
	$User = filter_input(INPUT_GET, 'User', FILTER_SANITIZE_URL);
	$Oper = filter_input(INPUT_GET, 'Oper', FILTER_SANITIZE_URL);
	
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------

//Post scores according to their type
if($Oper=="plus"){
	
	$result = mysqli_query($con,"UPDATE users SET ScorePlus = ScorePlus+1 where Pin='$User'");          //query
	mysqli_query($con, $result);
	/*
		$post[0]['AddType'];	
	*/ 
	mysqli_query($con, "UPDATE users SET Activity = Activity+1 WHERE Pin='$User'" );
	echo json_encode("Mesa MESΑ WasPlus=".$Oper); 	
	
}

if($Oper=="minus"){
	
	$result = mysqli_query($con,"UPDATE users SET ScoreMinus = ScoreMinus+1 where Pin='$User'");          //query         //query
	mysqli_query($con, $result);
	/*
		$post[0]['AddType'];	
	*/ 
	mysqli_query($con, "UPDATE users SET Activity = Activity+1 WHERE Pin='$User'" );
	echo json_encode("Mesa MESΑ WasMinus=".$Oper); 
	
}

if($Oper=="multy"){
	
	$result = mysqli_query($con,"UPDATE users SET ScoreMulty = ScoreMulty+1 where Pin='$User'");          //query           //query
	mysqli_query($con, $result);
	/*
		$post[0]['AddType'];	
	*/ 
	mysqli_query($con, "UPDATE users SET Activity = Activity+1 WHERE Pin='$User'" );
	echo json_encode("Mesa MESΑ WasMulty=".$Oper); 
	
}





if($Oper=="divy"){
	$result = mysqli_query($con,"UPDATE users SET ScoreDivy = ScoreDivy+1 where Pin='$User'");          //query          //query
	mysqli_query($con, $result);
	/*
		$post[0]['AddType'];	
	*/ 
	mysqli_query($con, "UPDATE users SET Activity = Activity+1 WHERE Pin='$User'" );
	echo json_encode(" Mesa MESΑ WasDivy=".$Oper); 
	
}




?>
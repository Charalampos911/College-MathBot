<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
	$Oper = filter_input(INPUT_GET, 'Oper', FILTER_SANITIZE_URL);
	$User = filter_input(INPUT_GET, 'User', FILTER_SANITIZE_URL);
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
	require 'db.php';  // database connection
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
 
	  echo '<script language="javascript">';
	  echo 'alert("Was scorePlus.php")';  //not showing an alert box.
	  echo '</script>';



 if($Oper=="plus"){
	  
	  echo '<script language="javascript">';
	  echo '//alert("was plus")';  //not showing an alert box.
	  echo '</script>';
	  
  }
  if($Oper=="minus"){
	  
	  echo '<script language="javascript">';
	  echo '//alert("was minus")';  //not showing an alert box.
	  echo '</script>';
	  
  }
  if($Oper=="multy"){
	  
	  echo '<script language="javascript">';
	  echo '//alert("was multy")';  //not showing an alert box.
	  echo '</script>';
	  
  }
  if($Oper=="divy"){
	  
	  echo '<script language="javascript">';
	  echo '//alert("was divy")';  //not showing an alert box.
	  echo '</script>';
	  
  }
	  echo '<script language="javascript">';
	  echo '//alert(" From PostScores --> $Oper= "+$Oper)';  //not showing an alert box.
	  echo '</script>';
	/*$result = mysqli_query($con,"INSERT INTO users(ScorePlus,ScoreMinus,ScoreMulty,ScoreDivy) values('$Oper') where Pin='$User'");          //query
	mysqli_query($con, $result);
	/*
		$post[0]['AddType'];	
	*/ 
	echo json_encode(true); 

?>
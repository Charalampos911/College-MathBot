<!DOCTYPE html>
<html>
<head>
	<title>WhiteBoard_API</title>
	<link rel="stylesheet" href="WhiteBoard_API/css/WhiteBoard_API_style_FHD.css">
	<link rel="stylesheet" href="WhiteBoard_API/css/WhiteBoard_API_style_HD.css">


</head>
<body>
	<div id="input_cont">
	
	<label>A:</label><input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="SpecialKey(event); if(this.value.length==9) return false;" id="NumberA" name="NumberA" placeholder="0" value=""><label>B:</label><input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="SpecialKey(event); if(this.value.length==9) return false;" id="NumberB" name="NumberB" placeholder="0" value=""><input type="button" id="oper" name="oper" value="+"><input type="button" id="btn_Start" name="btn_Start" value="&#8629;">
	</div>
	<div id="root_cont">
		<div id="main_PlusMinus">
			<?php include 'php/PlusMinus.php';?>
		</div>
		<div id="main_Multi" style="display:none;">
			<?php include 'php/Multi.php';?>
		</div>
		<div id="main_Divi" style="display:none;">
			<?php include 'php/Divi.php';?>
		</div>
		<div id="Instructions">
			<?php include 'php/Instructions.php';?>
		</div>

	</div>
	
	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='WhiteBoard_API/js/JQuery.js'></script>
	<script src='WhiteBoard_API/js/jquery-ui/jquery-ui.min.js'></script>
	<script src='WhiteBoard_API/js/big_Master/big.js'></script>
	<script src="WhiteBoard_API/js/Multiply.js"></script>
	<script src="WhiteBoard_API/js/Divy.js"></script>
	<script src="WhiteBoard_API/js/CountinBallz.js"></script>
	<script src="WhiteBoard_API/js/ControllersPlusMinus.js"></script>

	
	<script>
	//Cancel inputs - and + and E-e
function SpecialKey(e){
	
	console.log( "Handler for .keypress() called." );
    if (e.keyCode == 43 || e.keyCode == 45 || e.keyCode == 101  || e.keyCode == 69) { 
        event.preventDefault();
		console.log( "Was - or +" );
    }
}
	
	
	</script>
	
	
</body>

</html>
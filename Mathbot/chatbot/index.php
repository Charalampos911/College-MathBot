<!DOCTYPE html>
<html>
  <head>
    <title>Simple ChatAI using RiveScript.js</title>
	<link rel="stylesheet" href="chatbot/style.css">
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<style>

	
	</style>
<?php 
include("DebugToConsole.php");
require 'db.php';  // database connection
//GET transnumbers

  $result = mysqli_query($con,"SELECT * FROM transnumbers");          //query GET transnumbers
	$post = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$post[] = $row;
	}
//GET operators
  $result2 = mysqli_query($con,"SELECT * FROM operators");          //query
	$post2 = array();
	while($row = mysqli_fetch_assoc($result2))
	{
		$post2[] = $row;
	
	}
//GET specials
  $result3 = mysqli_query($con,"SELECT * FROM specials");          //query
	$post3 = array();
	while($row = mysqli_fetch_assoc($result3))
	{
		$post3[] = $row;
	}



?>
  
	
	<script charset="utf-8">
	$(document).ready(function(){
		
window.StringMathBasic=function(StrT){
	//alert("Πριν StrT="+StrT);

var MasterRegex = new RegExp(/(explain how much is)?\s?[+-]?([0-9]*[.])?[0-9]+\s?(plus|minus|times|divided by|multiplied by|div|\+|\-|\*|\/)\s?[+-]?([0-9]*[.])?[0-9]+/, "ig");
var NumbersRegex = new RegExp(/[+-]?([0-9]*[.])?[0-9]+/, "ig");

if(MasterRegex.test(StrT)){
		
	console.log("StrT.match(MasterRegex)= "+StrT.match(MasterRegex));

	StrT=String(StrT.match(MasterRegex));
	
	StrT = String(StrT).replace(/\./g, " p ");
	//alert("Μετα 44 StrT="+StrT);
	//Πρόσθεση
	
	var PlusRegex = new RegExp(/plus|\+/, "ig");
	if(PlusRegex.test(StrT)){
		
		StrT=StrT.replace(PlusRegex, ' plus ')
		console.log("New PLUS="+StrT);
		//StrT = StrT.replace(/\s\s+/g, ' ');
		//return  String(StrT);
		
	} //PlusRegex
	//Αφαίρεση
	
	var MinusRegex = new RegExp(/minus|\-/, "ig");
	if(MinusRegex.test(StrT)){
		
		StrT=StrT.replace(MinusRegex, ' minus ')
		console.log("New Minus="+StrT);
		//StrT = StrT.replace(/\s\s+/g, ' ');
		//return  String(StrT);
		
	} //MinusRegex
	//Πολλαπλασιασμό
	
	var MultiRegex = new RegExp(/times|multiplied by|\*/, "ig");
	if(MultiRegex.test(StrT)){
		
		StrT=StrT.replace(MultiRegex, ' times ')
		console.log("New Multi="+StrT);
		//StrT = StrT.replace(/\s\s+/g, ' ');
		//return  String(StrT);
		
	} //MultiRegex
	//Διαίρεση
	
	var DivRegex = new RegExp(/divided by|\//, "ig");
	if(DivRegex.test(StrT)){
		
		StrT=StrT.replace(DivRegex, ' div ')
		console.log("New Divi="+StrT);
		//StrT = StrT.replace(/\s\s+/g, ' ');
		//return  String(StrT);
		
	} //DivRegex
} //MasterRegex
	
		StrT = StrT.replace(/\s\s+/g, ' ');
		return  String(StrT);	
							
				
			}	// StringMathBasic	
		
		
//Μεταβλητες για την μετατροπη απο SpeechRecognition σε κατανοητο για την RiveScript
//Load from php the operators	
var operators = new Array();
    operators = <?php echo json_encode($post2); ?>;
//Then use them for speech correction	
		
//Load from php the transNumbers	
var transnumbers = new Array();
    transnumbers = <?php echo json_encode($post); ?>;
	console.log("transnumbers==>");
	console.log(transnumbers);
//Then use them for speech correction
//Load from php the specials	
var specials = new Array();
    specials = <?php echo json_encode($post3); ?>;
	
//Then use them for speech correction	
		
//Buttton to activate speechRecognition
	$Rec=false;
	$wasRec=false;
	$('#voiceInput').on('click', function(e) {
		//alert("clciked");
		//$("#voiceInput").addClass( "VoiceActive" );
		if($Rec){
			$Rec=false;
			recognition.stop();
			$("#voiceInput").removeClass( "VoiceActive" );
		}else{
			$Rec=true;
			$wasRec=true;
			if (noteContent.length) { //Add one white-space before continue
				noteContent += ' ';
			}
			recognition.start();
			
		}

	});	
	
//Buttton to activate Synthesis
$control=false;
	$('#Synth').on('click', function(e) {
		//alert("clicked");
		if($control){
			
			$control= false;
			//alert("control= false now");
			$("#Synth").removeClass( "SynthActive" );
		}else{
			$control= true;
			//alert("control= true now");
			$("#Synth").addClass( "SynthActive" );
		}
	});
window.TextProcess=function(StrT,WasRec){
	
	//alert(" text clicked");
	$wasRec= true;
	
//alert("WasRec 11="+String(WasRec));
if(WasRec){
//alert("$wasRec 22="+String($wasRec));
	//$wasRec=false;
	$Rec=false;
	recognition.stop();
	$("#voiceInput").removeClass( "VoiceActive" );
//alert("$wasRec 33="+String($wasRec));
	let str =StrT; 

		//Replace operators symbols with words
		//Replace specials with better-words
		let regex;
		var Oper="";	
		for (var i = 0; i < specials.length; i++) {
		
			regex = new RegExp(specials[i]["Regex"], "ig");
			
			str = String(str).replace(/,/g, "");
			str = [...String(str).replace(regex,specials[i]["NewStr"])];
		}
		//alert("<1>  str="+str);
		for (var i = 0; i < operators.length; i++) {
				
			str = [...String(str).split(operators[i]["Symbol"]).join(operators[i]["Name_EN"]+" ")];
			str = String(str).replace(/,/g, "");
			var strA= str.substr(0, str.indexOf(operators[i]["Name_EN"])); 
			var strB= str.substr(str.indexOf(operators[i]["Name_EN"]),); 
			//alert("strA="+strA+" _  operators[i][Name_EN]= "+operators[i]["Name_EN"])
			if(strA != ""){ 
				Oper=operators[i]["Name_EN"];
				//alert("SoS=="+Oper);
			}
		}
		//alert("<2>  strA="+strA);
		
		let regexA;
		let regexB;
		let regex2;

			
		//Replace word-Numbers with actual-numbers
	var newNumA = 0;

	var newNumB = 0;

	var newNumC1 = ""; //point-decimals

	var newNumC2 = ""; //point-decimals

	var ArrayA = [];

	var ArrayB = [];

	var SubC1="";
	var SubC2="";


	var ArrayC1 = []; //point decimals
	var ArrayC2 = []; //point decimals

	str = String(str).replace(/,/g, "");
	console.log("str= "+str);
	str = [...String(str).replace(/\b(\w*zero\w*)\b/g,"")]; //remove the word 'zero'
	str = String(str).replace(/,/g, "");


	regex2 = new RegExp(/\b(\w*point\w*)\b/g, "ig");

			var strA= str.substr(0, str.indexOf('plus')); 
			var strB= str.substr(str.indexOf('plus'),); 

	// ---> strA
	var AstrA=str;
		for (var i = transnumbers.length-1; i >0; i--) {
			regexA = new RegExp(transnumbers[i]["Grammaric"], "ig");
			AstrA = String(AstrA).replace(/,/g, "");
			var strA= AstrA.substr(0, AstrA.indexOf(''+Oper)); 
			//alert("NEO strA= "+strA);
			//Catch point decimals
				if(regex2.test(strA)){
					var strC1= strA.substr(String(strA).indexOf('point'),); 
					console.log("strC1 3333333= "+strC1);
					SubC1=strC1;
				}
				strA = String(strA).replace(/,/g, "");
				strA = [...String(strA).replace(strC1,"")];
				strA = String(strA).replace(/,/g, "");  // p
				console.log("strA after = "+strA);
			//Catch point decimals
			
			//Here we Add* the numbers found on each string
			if(regexA.test(strA)){
				//alert("haha "+transnumbers[i]["Numerico"]);
							newNumA = newNumA + Number(transnumbers[i]["Numerico"]);
							console.log("newNumA="+newNumA);
							ArrayA.push(transnumbers[i]["Numerico"]);
				//alert("h0h0 "+newNumA);
			}
			//Here we Add* the numbers found on each string
				console.log("strA="+String(strA));
			AstrA = String(AstrA).replace(/,/g, "");
			AstrA = [...String(AstrA).replace(regexA,transnumbers[i]["Numerico"])];
			AstrA = String(AstrA).replace(/,/g, "");
		}
	//alert("<3>  AstrA="+AstrA);
	// ----> strB
	var BstrB=str;
		for (var i = transnumbers.length-1; i >0; i--) {

			regexB = new RegExp(transnumbers[i]["Grammaric"], "ig");
	BstrB = String(BstrB).replace(/,/g, "");
	var strB= BstrB.substr(BstrB.indexOf(''+Oper),);
			//Here we check to see which operator to use
			//var strA= str.substr(0, str.indexOf('plus')); 
			//alert("strB="+strB);
			//Catch point decimals
				if(regex2.test(strB)){
					var strC2= strB.substr(String(strB).indexOf('point'),); 
					console.log("strC2 3333333= "+strC2);
					SubC2=strC2;
				}
				console.log("strB beforRE = "+strB);
				strB = String(strB).replace(/,/g, "");
				strB = [...String(strB).replace(strC2,"")];
				strB = String(strB).replace(/,/g, "");		
				console.log("strB after = "+strB);
			//Catch point decimals
			//alert("Grammaric= "+transnumbers[i]["Grammaric"]+" regexB = "+regexB +"strB= "+strB);
			if(regexB.test(strB)){
				//alert("haha B "+transnumbers[i]["Numerico"]);
							newNumB = newNumB + Number(transnumbers[i]["Numerico"]);
							console.log("newNumB="+newNumB);
							ArrayB.push(transnumbers[i]["Numerico"]);
			}
			BstrB = String(BstrB).replace(/,/g, "");
			BstrB = [...String(BstrB).replace(regexB,transnumbers[i]["Numerico"])];
			BstrB = String(BstrB).replace(/,/g, "");
			//alert("str="+str);
			//Here we Add* the numbers found on each string
		}//End of for() loop
		console.clear();
		console.log("SubC1="+SubC1);
		console.log("SubC2="+SubC2);
	//alert("<4>  BstrB="+BstrB);

		//calculate Decimals
		var AstrC1=str;
		var TempC1=0;

		var r = /\d+/g;
		var s = SubC1;
		var m;
		//Flags
		var Allow1000=0;
		var Allow100=0;
		var Allow20to90=0;
		var DecException=0;
		var SingleDigits=0;
	//Με την σειρα, βρες τις χιλιαδες, μετα τις εκατονταδες και εαν ακολουθουνται απο δεκαδες και μετα απο μοναδες,
	//Προσθεσε τες με την σειρα, και βγάλε το -μεγαλο νουμερο!- 1000 300 κενο 03 θα βγαλει: 1307!
		//alert("77 newNumC1= "+newNumC1);
		
		//alert("77 TempC1= "+TempC1);
		while ((m = r.exec(s)) != null) {
		 

				if(m[0]>=1000){
					if(Allow1000==1 || Allow100==1 || Allow20to90==1 || DecException==1 || SingleDigits==1  && TempC1!=0){
						newNumC1 = newNumC1+""+Number(TempC1); //Output ALL Prev
						TempC1=Number(m[0]); //Set 1000
					}else if(Allow1000==1 || Allow100==1 || Allow20to90==1 || DecException==1 || SingleDigits==1){
						TempC1=Number(m[0]); //Set 1000
					}else{
						TempC1=Number(m[0]); //Set 1000 ->for first time
					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						Allow1000=1;
						Allow100=0;
						Allow20to90=0;
						DecException=0;
						SingleDigits=0;
				}
				if(m[0]<1000 && m[0]>=100){
						

					if(Allow1000==1){ // not 1000
						TempC1 = TempC1 + Number(m[0]);
					}else if(Allow100==1 || Allow20to90==1 || DecException==1 || SingleDigits==1 && TempC1!=0){
						newNumC1 = newNumC1+""+TempC1; //Output last
						TempC1=Number(m[0]); //New 100
					}else if(Allow100==1 || Allow20to90==1 || DecException==1 || SingleDigits==1){
						TempC1=Number(m[0]); //New 100
					}else{
						
						TempC1=Number(m[0]); //Set 100
						
					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						Allow1000=0;
						Allow100=1;
						Allow20to90=0;
						DecException=0;
						SingleDigits=0;
					
				}// End 100's
				
				if(m[0]<100 && m[0]>=19){
					if(Allow1000==1 || Allow100==1){ 
						TempC1 = TempC1 + Number(m[0]);
				}else if(Allow20to90==1 || DecException==1 || SingleDigits==1 && TempC1!=0 ){
						newNumC1 = newNumC1+""+TempC1; //Output last
						TempC1=Number(m[0]); //New 20to90
					}else if(Allow20to90==1 || DecException==1 || SingleDigits==1 ){
						TempC1=Number(m[0]); //New 20to90
					}else{
						
						TempC1=Number(m[0]); //Set 20to90
						
					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						Allow1000=0;
						Allow100=0;
						Allow20to90=1;
						DecException=0;
						SingleDigits=0;
					
					
				}
				if(m[0]<19 && m[0]>=10){
					
					if(DecException==1 || SingleDigits==1 || Allow20to90 ==1 && TempC1!=0){
						newNumC1 = newNumC1+""+TempC1+""+Number(m[0]); //Output all
					
					}else if(DecException==1 || SingleDigits==1 || Allow20to90 ==1){
						newNumC1 = newNumC1+""+Number(m[0]); //Output all
					
					}else{ // 100+
						TempC1 = TempC1 + Number(m[0]); 
						newNumC1= newNumC1+""+TempC1; //Output
						

					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						TempC1=0; //clear	
						Allow1000=0;
						Allow100=0;
						Allow20to90=0;
						DecException=1;
						SingleDigits=0;
				}
				if(m[0]<10){
					//alert("PRE---> TempC1="+TempC1+"and m[0]="+Number(m[0]));
					if(DecException==1 || SingleDigits==1 && TempC1!=0){
						newNumC1 = newNumC1+""+TempC1+""+Number(m[0]); //Output all
					
					}else if(DecException==1 || SingleDigits==1 && TempC1==0){
						newNumC1 = newNumC1+""+Number(m[0]); //Output all
					
					}else{ // 20+
						TempC1 = TempC1 + Number(m[0]); 
						newNumC1= newNumC1+""+TempC1; //Output
						

					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						TempC1=0; //clear
						Allow1000=0;
						Allow100=0;
						Allow20to90=0;
						DecException=0;
						SingleDigits=1;
				}
		}  //While End
		//alert("<5>  newNumC1="+newNumC1);	
			
	// TempC2
		var TempC2=0;

		 r = /\d+/g;
		 s = SubC2;
		 m;
		//Flags
		 Allow1000=0;
		 Allow100=0;
		 Allow20to90=0;
		 DecException=0;
		 SingleDigits=0;

		while ((m = r.exec(s)) != null) {
		 

				if(m[0]>=1000){
					if(Allow1000==1 || Allow100==1 || Allow20to90==1 || DecException==1 || SingleDigits==1  && TempC2!=0){
						newNumC2 = newNumC2+""+Number(TempC2); //Output ALL Prev
						TempC2=Number(m[0]); //Set 1000
					}else if(Allow1000==1 || Allow100==1 || Allow20to90==1 || DecException==1 || SingleDigits==1){
						TempC2=Number(m[0]); //Set 1000
					}
					
					
					else{
						TempC2=Number(m[0]); //Set 1000 ->for first time
					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						Allow1000=1;
						Allow100=0;
						Allow20to90=0;
						DecException=0;
						SingleDigits=0;
				}
				if(m[0]<1000 && m[0]>=100){
						

					if(Allow1000==1){ // not 1000
						TempC2 = TempC2 + Number(m[0]);
					}else if(Allow100==1 || Allow20to90==1 || DecException==1 || SingleDigits==1 && TempC2!=0){
						newNumC2 = newNumC2+""+TempC2; //Output last
						TempC2=Number(m[0]); //New 100
					}else if(Allow100==1 || Allow20to90==1 || DecException==1 || SingleDigits==1){
						TempC2=Number(m[0]); //New 100
					}else{
						
						TempC2=Number(m[0]); //Set 100
						
					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						Allow1000=0;
						Allow100=1;
						Allow20to90=0;
						DecException=0;
						SingleDigits=0;
					
				}// End 100's
				
				if(m[0]<100 && m[0]>=19){
					if(Allow1000==1 || Allow100==1){ 
						TempC2 = TempC2 + Number(m[0]);
				}else if(Allow20to90==1 || DecException==1 || SingleDigits==1 && TempC2!=0 ){
						newNumC2 = newNumC2+""+TempC2; //Output last
						TempC2=Number(m[0]); //New 20to90
					}else if(Allow20to90==1 || DecException==1 || SingleDigits==1 ){
						TempC2=Number(m[0]); //New 20to90
					}else{
						
						TempC2=Number(m[0]); //Set 20to90
						
					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						Allow1000=0;
						Allow100=0;
						Allow20to90=1;
						DecException=0;
						SingleDigits=0;
					
					
				}
				if(m[0]<19 && m[0]>=10){
					
					if(DecException==1 || SingleDigits==1 || Allow20to90 ==1 && TempC2!=0){
						newNumC2 = newNumC2+""+TempC2+""+Number(m[0]); //Output all
					
					}else if(DecException==1 || SingleDigits==1 || Allow20to90 ==1){
						newNumC2 = newNumC2+""+Number(m[0]); //Output all
					
					}else{ // 100+
						TempC2 = TempC2 + Number(m[0]); 
						newNumC2= newNumC2+""+TempC2; //Output
						

					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						TempC2=0; //clear	
						Allow1000=0;
						Allow100=0;
						Allow20to90=0;
						DecException=1;
						SingleDigits=0;
				}
				if(m[0]<10){
					//alert("PRE---> TempC1="+TempC1+"and m[0]="+Number(m[0]));
					if(DecException==1 || SingleDigits==1 && TempC2!=0){
						newNumC2 = newNumC2+""+TempC2+""+Number(m[0]); //Output all
					
					}else if(DecException==1 || SingleDigits==1 && TempC2==0){
						newNumC2 = newNumC2+""+Number(m[0]); //Output all
					
					}else{ // 20+
						TempC2 = TempC2 + Number(m[0]); 
						newNumC2= newNumC2+""+TempC2; //Output
						

					}
					//alert("TempC1="+TempC1+"and m[0]="+Number(m[0]));
						TempC2=0; //clear
						Allow1000=0;
						Allow100=0;
						Allow20to90=0;
						DecException=0;
						SingleDigits=1;
				}
		}  //While End
				//alert("<6>  newNumC2="+newNumC2);
				//newNumC1= newNumC1+""+TempC1;
				/*/
				if(transnumbers[i]["Numerico"]>19 && transnumbers[i]["Numerico"]<28){
					
					newNumC1 = newNumC1 + Number(transnumbers[i]["Numerico"]);
					
				}*/
				/*	alert("i= "+i+" SubC1="+SubC1+" Decimal= "+transnumbers[i]["Numerico"]);
				//alert("haha B "+transnumbers[i]["Numerico"]);
							newNumC1 = newNumC1 + Number(transnumbers[i]["Numerico"]);
							console.log("newNumC1="+newNumC1);
							//ArrayB.push(transnumbers[i]["Numerico"]);*/
			
			///BstrB = String(BstrB).replace(/,/g, "");
			//BstrB = [...String(BstrB).replace(regexC1,transnumbers[i]["Numerico"])];
			//BstrB = String(BstrB).replace(/,/g, "");
			//alert("str="+str);
			//Here we Add* the numbers found on each string
		//End of for() loop
	//calculate Decimals
		
		
		
		
	/*	console.log("str="+String(str).replace(/,/g, ""));
		console.log("strA="+String(strA));
		console.log("newNumC1="+newNumC1)
		console.log("strB="+String(strB));
		console.log("newNumC2="+newNumC2)
		
		//console.log("strB2="+String(strB2));
		console.log("strC1= "+String(strC1));
		console.log("strC2= "+String(strC2));	
		console.log("newNumA="+newNumA);
		console.log("newNumB="+newNumB);
		
		console.log("ArrayA_1="+ArrayA[0]);
		console.log("ArrayA_1="+ArrayA[1]);
		console.log("ArrayA_1="+ArrayA[2]);
		console.log("ArrayA_1="+ArrayA[3]);
		console.log("ArrayA_1="+ArrayA[4]);
		console.log("ArrayA_1="+ArrayA[5]);
		console.log("ArrayA_1="+ArrayA[6]);
		console.log("ArrayA_1="+ArrayA[7]);
		
		console.log("ArrayB_1="+ArrayB[0]);
		console.log("ArrayB_1="+ArrayB[1]);
		console.log("ArrayB_1="+ArrayB[2]);
		console.log("ArrayB_1="+ArrayB[3]);
		console.log("ArrayB_1="+ArrayB[4]);
		console.log("ArrayB_1="+ArrayB[5]);
		console.log("ArrayB_1="+ArrayB[6]);
		console.log("ArrayB_1="+ArrayB[7]);
		
		console.log("SubC1="+SubC1);
		console.log("SubC2="+SubC2);*/
		if(newNumC1!=""){
			//alert("okeyyyyyyy n777= "+newNumC1);
			 newNumA = newNumA+"."+newNumC1;
		}
		if(newNumC2!=""){
			//alert("okeyyyyyyy n777= "+newNumC2);
			newNumB = newNumB+"."+newNumC2;
		}
		
		
		
		for (var i = 0; i <ArrayA.length-1; i++) {
			
			strA = String(strA).replace(/,/g, "");
			strA = [...String(strA).replace(ArrayA[i],'')];
		}
		strA = [...String(strA).replace(ArrayA[ArrayA.length-1],newNumA)];
		strA = String(strA).replace(/,/g, "");
		//console.log("strA 4444="+strA);
		//alert("<7>  strA="+strA);
		for (var i = 0; i <ArrayB.length-1; i++) {
			
			strB = String(strB).replace(/,/g, "");
			strB = [...String(strB).replace(ArrayB[i],'')];
		}
		strB = [...String(strB).replace(ArrayB[ArrayB.length-1],newNumB)];
		strB = String(strB).replace(/,/g, "");
		//console.log("strB 4444="+strB);
		//alert("<8>  strB="+strB);


		//regex = new RegExp(transnumbers[i]["Grammaric"], "ig");
		//strA = [...String(strA).replace(regex,newNumA)];
		
	/*		var numberPattern = /\b\d+\b/gi;
			var AllNumbs = String(str).match(numberPattern);
		
			console.log("AllNumbs="+AllNumbs);
	*/	
		console.log("strA="+String(strA));
		console.log("newNumC1="+newNumC1)
		console.log("strB="+String(strB));
		console.log("newNumC2="+newNumC2)
	//--------
	//if only 1 number is given, that is strB for decimals
	/*var DecRegex = new RegExp(/[+-]?([0-9]*[.])?[0-9]+/, "ig");
	if(DecRegex.test(strB) && DecRegex.test(strA)!= true){
		
		//alert("Bravoooooooooooooooooo");
		strB=strB+" end";
	}*/

	//strA = String(strA).replace(/\./g, " p ");
	//strB = String(strB).replace(/\./g, " p ");
	var finalStr=strA+""+strB;
	finalStr = finalStr.replace(/  +/g, ' '); //Remove double white-spaces
// Eλληνικά μετατροπή
//let regex5; //do --> να κάνουμε

//let regex6; //oper (πρόσθεση|αφαίρεση|πολλαπλασιασμό|διαίρεση)--> (plus|minus|multiply|divide)
//let regex7; //of the number --> του νούμερου
//let regex8; //number--> νούμερο (ένα|δύο|τρία|τέσσερα|πέντε|έξι|εφτά|οκτώ|εννιά|όλα)
							 -->(one|two|three|four|five|six|seven|eight|nine|all)

//let regex9; //easy-hard ->> εύκολο-δύσκολο
let regex10;// my pin is 
let regex11;// από την αρχή --> begin again
let regex12;// εξήγησε πόσο κάνει (# oper #)




//alert("my 45-98 finalStr= "+finalStr);
	$("#userInput").val(StringMathBasic(cleanString(finalStr)));
}else{
//alert("my 45-99 StrT= "+StrT);
	$("#userInput").val(StringMathBasic(cleanString(StrT)));
	
	
}

		
}


window.cleanString=function(input){
    var output = "";
	var count=0;
    for (var i=0; i<input.length; i++) {
        if (input.charCodeAt(i) <= 127) {
            output += input.charAt(i);
			count+=1;
			
        }
    }
    return output;
}

window.GreekTxtProcess=function(StrT){
	
var DecRegex = new RegExp(/(εξ(η|ή)γησε μου π(ο|ό)σο κ(α|ά)νει το)? [+-]?([0-9]*[.])?[0-9]+ (φορές|φορες|φορές το|φορες το|συν|συν το|πλην|πλην το|σύν|σύν το|πλήν|πλήν το|μίον|μίον το|μιον|μιον το|και|και το|επί|επί το|επι|επι το|διά|διά το|δια|δια το|\+|\-|\*|\/) [+-]?([0-9]*[.])?[0-9]+/, "ig");
if(DecRegex.test(StrT)){
		
	var PlusRegex = new RegExp(/\+/, "ig");
		StrT=StrT.replace(PlusRegex, 'συν')
	var MinusRegex = new RegExp(/\-/, "ig");	
		StrT=StrT.replace(MinusRegex, 'πλήν');	
	var MultiRegex = new RegExp(/\*/, "ig");
		StrT=StrT.replace(MultiRegex, 'επί');
	var DivRegex = new RegExp(/\//, "ig");
		StrT=StrT.replace(DivRegex, 'διά');


	//alert("Bravoooooooooooooooooo");
	//alert("DecRegex 11 StrT= "+StrT);
	StrT=String(StrT.match(DecRegex));

	
	//alert("DecRegex 22 StrT= "+StrT);
	
}	
	
	
	
	
//var p = 'να κάνουμε πρόσθεση του νούμερου πέντε';

p=StrT;

const regex5 = /να κ(α|ά)νουμε /gi;
//alert(p.replace(regex5, 'do ')); //να κάνουμε
if(regex5.test(p)){
	//alert("Yparxei: να κανουμε");
	
	p=p.replace(regex5, 'do ');

		const regex61gh = /τυχα(ι|ί)ο τελεστ(η|ή)/gi;
		//alert(p.replace(regex61, 'plus')); // να κάνουμε πρόσθεση
		p=p.replace(regex61gh, 'any operator');

		const regex62gh = /τυχα(ι|ί)ο νο(ύ|υ)μερο/gi;
		//alert(p.replace(regex61, 'plus')); // να κάνουμε πρόσθεση
		p=p.replace(regex62gh, 'any number');

		const regex63gh = /γει(α|ά) σου|καλημ(ε|έ)ρα|τι κ(α|ά)νεις/gi;
		//alert(p.replace(regex61, 'plus')); // να κάνουμε πρόσθεση
		p=p.replace(regex63gh, 'hello');

		const regex64gh = /καλην(υ|ύ)χτα|αντ(ι|ί)ο|αντε γει(α|ά)/gi;
		//alert(p.replace(regex61, 'plus')); // να κάνουμε πρόσθεση
		p=p.replace(regex64gh, 'good night');

		const regex61 = /(πρ(ο|ό)σθεση|σ(υ|ύ)ν|και)/gi;
		//alert(p.replace(regex61, 'plus')); // να κάνουμε πρόσθεση
		p=p.replace(regex61, 'plus');

		const regex62 = /(αφα(ι|ί)ρεση|πλ(η|ή)ν)/gi;
		//alert(p.replace(regex62, 'minus')); // να κάνουμε αφαίρεση
		p=p.replace(regex62, 'minus');

		const regex63 = /(πολλαπλασιασμ(ο|ό)|επ(ι|ί))/gi;
		//alert(p.replace(regex63, 'multiply')); //να κάνουμε πολλαπλασιασμό
		p=p.replace(regex63, 'multiply');

		const regex64 = /(δια(ι|ί)ρεση|δι(α|ά))/gi;
		//alert(p.replace(regex64, 'divide')); //να κάνουμε διαίρεση
		p=p.replace(regex64, 'divide');

	const regex7 = /το[υ]? νο(υ|ύ)μερο[υ]?/gi;
	//alert(p.replace(regex7, 'of the number')); //το νούμερο δυο
	p=p.replace(regex7, 'of the number');

	const regex71 = /νο(υ|ύ)μερο[υ]?/gi;
	//alert(p.replace(regex71, 'of the number')); //το νούμερο δυο
	p=p.replace(regex71, 'number');

	const regex72 = /τελεστ(ή|η)?/gi;
	//alert(p.replace(regex72, 'of the number')); //το νούμερο δυο
	p=p.replace(regex72, 'operator');
	
		const regex81 = /ένα|ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex81, 'one');

		const regex82 = /δύο|δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex82, 'two');

		const regex83 = /τρία|τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex83, 'three');

		const regex84 = /τέσσερα|τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex84, 'four');

		const regex85 = /πέντε|πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex85, 'five');


		const regex86 = /έξι|εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex86, 'six');

		const regex87 = /εφτά|εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex87, 'seven');

		const regex88 = /οκτώ|οκτω|οχτώ|οχτω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex88, 'eight');


		const regex89 = /εννιά|εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex89, 'nine');

	const regex810 = /όλα|ολα/gi;
	//alert(p.replace(regex89, 'All'));//να κάνουμε πρόσθεση του νούμερου ολα
	p=p.replace(regex810, 'any');

	const regex811 = /τυχαία|τυχαια/gi;
	//alert(p.replace(regex89, 'All'));//να κάνουμε πρόσθεση του νούμερου ολα
	p=p.replace(regex811, 'any');


	const regex91 = /εύκολο|ευκoλο|ευκoλες|εύκολες/gi;  //να κάνουμε εύκολο
	//alert(p.replace(regex91, 'easy'));
	p=p.replace(regex91, 'easy');

	const regex92 = /δυσκολο|δύσκολο|δυσκολές|δυσκολες/gi; //να κάνουμε δυσκολες
	//alert(p.replace(regex92, 'hard'));
	p=p.replace(regex92, 'hard');
		
	const regex93 = /μερικές|μερικες|λίγες|λιγες/gi; //να κάνουμε λιγες δυσκολες
	//alert(p.replace(regex92, 'some'));
	p=p.replace(regex93, 'some');
}
	const regex10 = /το (πιν|pin) μου ε(ι|ί)ναι/gi; //το πιν μου είναι 12345
	//alert(p.replace(regex10, 'my pin is '));
	p=p.replace(regex10, 'my pin is');
	//alert("2323-11 p="+p);
	
var regex101 = new RegExp(/my pin is \s?[+-]?([0-9]*[.])?[0-9]+/,"ig");
if(regex101.test(p)){
		
	//alert("Bravoooooooooooooooooo 4545-33 p="+p);

	p=String(p.match(regex101));
	//alert("StrT= "+StrT);
	
}
	
	


const regex11 = /(απ(ο|ό) την αρχ(η|ή)|π(α|ά) με π(α|ά)λι)/gi; //απο την αρχή 
//alert(p.replace(regex11, 'begin again')); 						// πάμε παλι)
p=p.replace(regex11, 'begin again');

var regex102 = new RegExp(/begin again/,"ig");
if(regex102.test(p)){
		
	//alert("Bravoooooooooooooooooo 4545-33 p="+p);

	p=String(p.match(regex102));
	//alert("StrT= "+StrT);
	
}
//New staff
const regex1031 = /Γει(ά|α) σου|Καλημ(έ|ε)ρα/gi; //καλημέρα
//alert(p.replace(regex1031, 'good night')); 						// πάμε παλι)
p=p.replace(regex1031, 'Hello');


const regex1032 = /καλην(ύ|υ)χτα|αντ(ί|ι)ο/gi; //καληνύχτα
//alert(p.replace(regex1032, 'good night')); 						// πάμε παλι)
p=p.replace(regex1032, 'good night');


const regex104 = /το (ό|ο)νομα μου ε(ί|ι)ναι|με λ(έ|ε)νε/gi; //το όνομα μου είναι Νίκος
//alert(p.replace(regex104, 'my name is')); 						// πάμε παλι)
p=p.replace(regex104, 'my name is');
//alert("p1= "+p);
const regex1041 = /my name is [^\x00-\x7F]+/gi; //το όνομα μου είναι Νίκος
//alert(p.replace(regex1041, 'my name is')); 						// πάμε παλι)
//p=p.replace(regex1041, 'my name is');
//alert("p2= "+p);
//alert("p.match(regex1041)="+ p.match(regex1041));
if(p.match(regex1041)){
	const found = p.match(regex1041);
	//alert("found haha= "+found);	
	
	
	//alert("found22 haha22= "+String(found).slice(11));
	CurrentUser.Nick=String(found).slice(11);
}



		const regex131 = /(σ(υ|ύ)ν|και)/gi;
		//alert(p.replace(regex61, 'plus')); // να κάνουμε πρόσθεση
		p=p.replace(regex131, 'plus');

		const regex132 = /(πλ(η|ή)ν|μ(ι|ί)ον)/gi;
		//alert(p.replace(regex62, 'minus')); // να κάνουμε αφαίρεση
		p=p.replace(regex132, 'minus');

		const regex133 = /(επ(ι|ί))/gi;
		//alert(p.replace(regex63, 'multiply')); //να κάνουμε πολλαπλασιασμό
		p=p.replace(regex133, 'multiply');

		const regex134 = /(δι(α|ά))/gi;
		//alert(p.replace(regex64, 'divide')); //να κάνουμε διαίρεση
		p=p.replace(regex134, 'divide');



//alert("111 explain="+p);
const regex12 = /εξ(η|ή)γησ(ε|έ) μου π(ο|ό)σο κ(α|ά)νει το/gi; // εξήγησε μου πόσο κάνει το 5 συν 7
//alert(p.replace(regex12, 'explain how much is'));
p=p.replace(regex12, 'explain how much is');
//alert("222 explain="+p);

//φορές|φορες|φορές το|φορες το|συν|πλην|σύν|πλήν|μίον|μιον|και|επί|επι|διά|δια

	const regexGX1 = /φορές το|φορες το/gi; //βγάλε το "το"
	p=p.replace(regexGX1, 'times');
	const regexGX2 = /σύν το|συν το/gi; //βγάλε το "το"
	p=p.replace(regexGX2, 'plus');
	const regexGX3 = /πλήν το|πλην το/gi; //βγάλε το "το"
	p=p.replace(regexGX3, 'minus');
	const regexGX4 = /μίον το|μιον το/gi; //βγάλε το "το"
	p=p.replace(regexGX4, 'minus');
	const regexGX5 = /και το/gi; //βγάλε το "το"
	p=p.replace(regexGX5, 'plus');
	const regexGX6 = /επί το|επι το/gi; //βγάλε το "το"
	p=p.replace(regexGX6, 'times');
	const regexGX7 = /διά το|δια το/gi; //βγάλε το "το"
	p=p.replace(regexGX7, 'divided by');
	//alert("My new p= "+p);

var regex105 = new RegExp(/explain how much is ([+-]?([0-9]*[.])?[0-9]+\s?(plus|minus|times|divided by|multiplied by|div|\+|\-|\*|\/)\s?[+-]?([0-9]*[.])?[0-9]+)/,"ig");
if(regex105.test(p)){ //explain how much is 5 plus 7
		
	//alert("Bravoooooooooooooooooo 4545-33 p="+p);

	p=String(p.match(regex105));
	//alert("Bravoooooooooooooooooo 4545-34 p="+p);
	//alert("StrT= "+StrT);
	
}
//Βασικά νούμερα, ωμές απαντήσεις
	//εκατοντάδες	
		//εκατοντάδες
	//εκατοντάδες
	
	
		const regex111xf2 = /εκατ(ό|ο)ν έντεκα|εκατ(ό|ο)ν εντεκα/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex111xf2, '111');
		
		const regex189xf3 = /εκατ(ό|ο)ν δώδεκα|εκατ(ό|ο)ν δωδεκα/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex189xf3, '112');
		

		const regex113xf = /εκατ(ό|ο)ν δ(ε|έ)κα τρία|εκατ(ό|ο)ν δ(ε|έ)κα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex113xf, '113');

		const regex114xf = /εκατ(ό|ο)ν δ(ε|έ)κα τέσσερα|εκατ(ό|ο)ν δ(ε|έ)κα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex114xf, '114');

		const regex115xf = /εκατ(ό|ο)ν δ(ε|έ)κα πέντε|εκατ(ό|ο)ν δ(ε|έ)κα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex115xf, '115');


		const regex116xf = /εκατ(ό|ο)ν δ(ε|έ)κα έξι|εκατ(ό|ο)ν δ(ε|έ)κα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex116xf, '116');

		const regex117xf = /εκατ(ό|ο)ν δ(ε|έ)κα εφτά|εκατ(ό|ο)ν δ(ε|έ)κα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex117xf, '117');

		const regex118xf = /εκατ(ό|ο)ν δ(ε|έ)κα ο(κ|χ)τώ|εκατ(ό|ο)ν δ(ε|έ)κα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex118xf, '118');
		
		const regex119xf = /εκατ(ό|ο)ν δ(ε|έ)κα εννιά|εκατ(ό|ο)ν δ(ε|έ)κα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex119xf, '119');
		
		
		const regex121xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι ένα|εκατ(ό|ο)ν ε(ι|ί)κοσι ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex121xf, '121');

		const regex122xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι δύο|εκατ(ό|ο)ν ε(ι|ί)κοσι δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex122xf, '122');

		const regex123xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι τρία|εκατ(ό|ο)ν ε(ι|ί)κοσι τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex123xf, '123');

		const regex124xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι τέσσερα|εκατ(ό|ο)ν ε(ι|ί)κοσι τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex124xf, '124');

		const regex125xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι πέντε|εκατ(ό|ο)ν ε(ι|ί)κοσι πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex125xf, '125');

		const regex126xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι έξι|εκατ(ό|ο)ν ε(ι|ί)κοσι εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex126xf, '126');

		const regex127xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι εφτά|εκατ(ό|ο)ν ε(ι|ί)κοσι εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex127xf, '127');

		const regex128xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι ο(κ|χ)τώ|εκατ(ό|ο)ν ε(ι|ί)κοσι ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex128xf, '128');

		const regex129xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι εννιά|εκατ(ό|ο)ν ε(ι|ί)κοσι εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex129xf, '129');

		const regex131xf = /εκατ(ό|ο)ν τρι(α|ά)ντα ένα|εκατ(ό|ο)ν τρι(α|ά)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex131xf, '131');

		const regex132xf = /εκατ(ό|ο)ν τρι(α|ά)ντα δύο|εκατ(ό|ο)ν τρι(α|ά)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex132xf, '132');

		const regex133xf = /εκατ(ό|ο)ν τρι(α|ά)ντα τρία|εκατ(ό|ο)ν τρι(α|ά)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex133xf, '133');

		const regex134xf = /εκατ(ό|ο)ν τρι(α|ά)ντα τέσσερα|εκατ(ό|ο)ν τρι(α|ά)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex134xf, '134');

		const regex135xf = /εκατ(ό|ο)ν τρι(α|ά)ντα πέντε|εκατ(ό|ο)ν τρι(α|ά)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex135xf, '135');


		const regex136xf = /εκατ(ό|ο)ν τρι(α|ά)ντα έξι|εκατ(ό|ο)ν τρι(α|ά)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex136xf, '136');

		const regex137xf = /εκατ(ό|ο)ν τρι(α|ά)ντα εφτά|εκατ(ό|ο)ν τρι(α|ά)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex137xf, '137');

		const regex138xf = /εκατ(ό|ο)ν τρι(α|ά)ντα ο(κ|χ)τώ|εκατ(ό|ο)ν τρι(α|ά)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex138xf, '138');


		const regex139xf = /εκατ(ό|ο)ν τρι(α|ά)ντα εννιά|εκατ(ό|ο)ν τρι(α|ά)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex139xf, '139');

		const regex141xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα ένα|εκατ(ό|ο)ν σαρ(α|ά)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex141xf, '141');

		const regex142xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα δύο|εκατ(ό|ο)ν σαρ(α|ά)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex142xf, '142');

		const regex143xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα τρία|εκατ(ό|ο)ν σαρ(α|ά)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex143xf, '143');

		const regex144xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα τέσσερα|εκατ(ό|ο)ν σαρ(α|ά)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex144xf, '144');

		const regex145xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα πέντε|εκατ(ό|ο)ν σαρ(α|ά)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex145xf, '145');


		const regex146xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα έξι|εκατ(ό|ο)ν σαρ(α|ά)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex146xf, '146');

		const regex147xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα εφτά|εκατ(ό|ο)ν σαρ(α|ά)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex147xf, '147');

		const regex148xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα ο(κ|χ)τώ|εκατ(ό|ο)ν σαρ(α|ά)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex148xf, '148');


		const regex149xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα εννιά|εκατ(ό|ο)ν σαρ(α|ά)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex149xf, '149');

		const regex151xf = /εκατ(ό|ο)ν πεν(η|ή)ντα ένα|εκατ(ό|ο)ν πεν(η|ή)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex151xf, '151');

		const regex152xf = /εκατ(ό|ο)ν πεν(η|ή)ντα δύο|εκατ(ό|ο)ν πεν(η|ή)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex152xf, '152');

		const regex153xf = /εκατ(ό|ο)ν πεν(η|ή)ντα τρία|εκατ(ό|ο)ν πεν(η|ή)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex153xf, '153');

		const regex154xf = /εκατ(ό|ο)ν πεν(η|ή)ντα τέσσερα|εκατ(ό|ο)ν πεν(η|ή)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex154xf, '154');

		const regex155xf = /εκατ(ό|ο)ν πεν(η|ή)ντα πέντε|εκατ(ό|ο)ν πεν(η|ή)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex155xf, '155');


		const regex156xf = /εκατ(ό|ο)ν πεν(η|ή)ντα έξι|εκατ(ό|ο)ν πεν(η|ή)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex156xf, '156');

		const regex157xf = /εκατ(ό|ο)ν πεν(η|ή)ντα εφτά|εκατ(ό|ο)ν πεν(η|ή)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex157xf, '157');

		const regex158xf = /εκατ(ό|ο)ν πεν(η|ή)ντα ο(κ|χ)τώ|εκατ(ό|ο)ν πεν(η|ή)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex158xf, '158');


		const regex159xf = /εκατ(ό|ο)ν πεν(η|ή)ντα εννιά|εκατ(ό|ο)ν πεν(η|ή)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex159xf, '159');





		const regex161xf = /εκατ(ό|ο)ν εξ(ή|η)ντα ένα|εκατ(ό|ο)ν εξ(ή|η)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex161xf, '161');

		const regex162xf = /εκατ(ό|ο)ν εξ(ή|η)ντα δύο|εκατ(ό|ο)ν εξ(ή|η)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex162xf, '162');

		const regex163xf = /εκατ(ό|ο)ν εξ(ή|η)ντα τρία|εκατ(ό|ο)ν εξ(ή|η)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex163xf, '163');

		const regex164xf = /εκατ(ό|ο)ν εξ(ή|η)ντα τέσσερα|εκατ(ό|ο)ν εξ(ή|η)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex164xf, '164');

		const regex165xf = /εκατ(ό|ο)ν εξ(ή|η)ντα πέντε|εκατ(ό|ο)ν εξ(ή|η)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex165xf, '165');


		const regex166xf = /εκατ(ό|ο)ν εξ(ή|η)ντα έξι|εκατ(ό|ο)ν εξ(ή|η)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex166xf, '166');

		const regex167xf = /εκατ(ό|ο)ν εξ(ή|η)ντα εφτά|εκατ(ό|ο)ν εξ(ή|η)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex167xf, '167');

		const regex168xf = /εκατ(ό|ο)ν εξ(ή|η)ντα ο(κ|χ)τώ|εκατ(ό|ο)ν εξ(ή|η)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex168xf, '168');


		const regex169xf = /εκατ(ό|ο)ν εξ(ή|η)ντα εννιά|εκατ(ό|ο)ν εξ(ή|η)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex169xf, '169');
		
		const regex171xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα ένα|εκατ(ό|ο)ν εβδομ(ή|η)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex171xf, '171');

		const regex172xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα δύο|εκατ(ό|ο)ν εβδομ(ή|η)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex172xf, '172');

		const regex173xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα τρία|εκατ(ό|ο)ν εβδομ(ή|η)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex173xf, '173');

		const regex174xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα τέσσερα|εκατ(ό|ο)ν εβδομ(ή|η)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex174xf, '174');

		const regex175xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα πέντε|εκατ(ό|ο)ν εβδομ(ή|η)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex175xf, '175');


		const regex176xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα έξι|εκατ(ό|ο)ν εβδομ(ή|η)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex176xf, '176');

		const regex177xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα εφτά|εκατ(ό|ο)ν εβδομ(ή|η)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex177xf, '177');

		const regex178xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα ο(κ|χ)τώ|εκατ(ό|ο)ν εβδομ(ή|η)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex178xf, '178');


		const regex179xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα εννιά|εκατ(ό|ο)ν εβδομ(ή|η)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex179xf, '179');


	//εκατοντάδες	
		//εκατοντάδες
	//εκατοντάδες
		
	
		const regex89xf2 = /έντεκα|εντεκα/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex89xf2, '11');
		
		const regex89xf3 = /δώδεκα|δωδεκα/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex89xf3, '12');
		

		const regex13xf = /δ(έ|ε)κα τρία|δ(έ|ε)κα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex13xf, '13');

		const regex14xf = /δ(έ|ε)κα τέσσερα|δ(έ|ε)κα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex14xf, '14');

		const regex15xf = /δ(έ|ε)κα πέντε|δ(έ|ε)κα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex15xf, '15');


		const regex16xf = /δ(έ|ε)κα έξι|δ(έ|ε)κα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex16xf, '16');

		const regex17xf = /δ(έ|ε)κα εφτά|δ(έ|ε)κα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex17xf, '17');

		const regex18xf = /δ(έ|ε)κα ο(κ|χ)τώ|δ(έ|ε)κα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex18xf, '18');
		
		const regex19xf = /δ(έ|ε)κα εννιά|δ(έ|ε)κα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex19xf, '19');
		
		
		const regex21xf = /ε(ι|ί)κοσι ένα|ε(ι|ί)κοσι ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex21xf, '21');

		const regex22xf = /ε(ι|ί)κοσι δύο|ε(ι|ί)κοσι δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex22xf, '22');

		const regex23xf = /ε(ι|ί)κοσι τρία|ε(ι|ί)κοσι τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex23xf, '23');

		const regex24xf = /ε(ι|ί)κοσι τέσσερα|ε(ι|ί)κοσι τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex24xf, '24');

		const regex25xf = /ε(ι|ί)κοσι πέντε|ε(ι|ί)κοσι πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex25xf, '25');

		const regex26xf = /ε(ι|ί)κοσι έξι|ε(ι|ί)κοσι εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex26xf, '26');

		const regex27xf = /ε(ι|ί)κοσι εφτά|ε(ι|ί)κοσι εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex27xf, '27');

		const regex28xf = /ε(ι|ί)κοσι ο(κ|χ)τώ|ε(ι|ί)κοσι ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex28xf, '28');

		const regex29xf = /ε(ι|ί)κοσι εννιά|ε(ι|ί)κοσι εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex29xf, '29');

		const regex31xf = /τρι(α|ά)ντα ένα|τρι(α|ά)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex31xf, '31');

		const regex32xf = /τρι(α|ά)ντα δύο|τρι(α|ά)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex32xf, '32');

		const regex33xf = /τρι(α|ά)ντα τρία|τρι(α|ά)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex33xf, '33');

		const regex34xf = /τρι(α|ά)ντα τέσσερα|τρι(α|ά)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex34xf, '34');

		const regex35xf = /τρι(α|ά)ντα πέντε|τρι(α|ά)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex35xf, '35');


		const regex36xf = /τρι(α|ά)ντα έξι|τρι(α|ά)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex36xf, '36');

		const regex37xf = /τρι(α|ά)ντα εφτά|τρι(α|ά)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex37xf, '37');

		const regex38xf = /τρι(α|ά)ντα ο(κ|χ)τώ|τρι(α|ά)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex38xf, '38');


		const regex39xf = /τρι(α|ά)ντα εννιά|τρι(α|ά)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex39xf, '39');

		const regex41xf = /σαρ(α|ά)ντα ένα|σαρ(α|ά)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex41xf, '41');

		const regex42xf = /σαρ(α|ά)ντα δύο|σαρ(α|ά)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex42xf, '42');

		const regex43xf = /σαρ(α|ά)ντα τρία|σαρ(α|ά)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex43xf, '43');

		const regex44xf = /σαρ(α|ά)ντα τέσσερα|σαρ(α|ά)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex44xf, '44');

		const regex45xf = /σαρ(α|ά)ντα πέντε|σαρ(α|ά)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex45xf, '45');


		const regex46xf = /σαρ(α|ά)ντα έξι|σαρ(α|ά)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex46xf, '46');

		const regex47xf = /σαρ(α|ά)ντα εφτά|σαρ(α|ά)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex47xf, '47');

		const regex48xf = /σαρ(α|ά)ντα ο(κ|χ)τώ|σαρ(α|ά)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex48xf, '48');


		const regex49xf = /σαρ(α|ά)ντα εννιά|σαρ(α|ά)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex49xf, '49');

		const regex51xf = /πεν(η|ή)ντα ένα|πεν(η|ή)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex51xf, '51');

		const regex52xf = /πεν(η|ή)ντα δύο|πεν(η|ή)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex52xf, '52');

		const regex53xf = /πεν(η|ή)ντα τρία|πεν(η|ή)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex53xf, '53');

		const regex54xf = /πεν(η|ή)ντα τέσσερα|πεν(η|ή)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex54xf, '54');

		const regex55xf = /πεν(η|ή)ντα πέντε|πεν(η|ή)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex55xf, '55');


		const regex56xf = /πεν(η|ή)ντα έξι|πεν(η|ή)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex56xf, '56');

		const regex57xf = /πεν(η|ή)ντα εφτά|πεν(η|ή)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex57xf, '57');

		const regex58xf = /πεν(η|ή)ντα ο(κ|χ)τώ|πεν(η|ή)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex58xf, '58');


		const regex59xf = /πεν(η|ή)ντα εννιά|πεν(η|ή)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex59xf, '59');





		const regex61xf = /εξ(ή|η)ντα ένα|εξ(ή|η)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex61xf, '61');

		const regex62xf = /εξ(ή|η)ντα δύο|εξ(ή|η)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex62xf, '62');

		const regex63xf = /εξ(ή|η)ντα τρία|εξ(ή|η)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex63xf, '63');

		const regex64xf = /εξ(ή|η)ντα τέσσερα|εξ(ή|η)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex64xf, '64');

		const regex65xf = /εξ(ή|η)ντα πέντε|εξ(ή|η)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex65xf, '65');


		const regex66xf = /εξ(ή|η)ντα έξι|εξ(ή|η)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex66xf, '66');

		const regex67xf = /εξ(ή|η)ντα εφτά|εξ(ή|η)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex67xf, '67');

		const regex68xf = /εξ(ή|η)ντα ο(κ|χ)τώ|εξ(ή|η)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex68xf, '68');


		const regex69xf = /εξ(ή|η)ντα εννιά|εξ(ή|η)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex69xf, '69');
		
		const regex71xf = /εβδομ(ή|η)ντα ένα|εβδομ(ή|η)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex71xf, '71');

		const regex72xf = /εβδομ(ή|η)ντα δύο|εβδομ(ή|η)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex72xf, '72');

		const regex73xf = /εβδομ(ή|η)ντα τρία|εβδομ(ή|η)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex73xf, '73');

		const regex74xf = /εβδομ(ή|η)ντα τέσσερα|εβδομ(ή|η)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex74xf, '74');

		const regex75xf = /εβδομ(ή|η)ντα πέντε|εβδομ(ή|η)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex75xf, '75');


		const regex76xf = /εβδομ(ή|η)ντα έξι|εβδομ(ή|η)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex76xf, '76');

		const regex77xf = /εβδομ(ή|η)ντα εφτά|εβδομ(ή|η)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex77xf, '77');

		const regex78xf = /εβδομ(ή|η)ντα ο(κ|χ)τώ|εβδομ(ή|η)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex78xf, '78');


		const regex79xf = /εβδομ(ή|η)ντα εννιά|εβδομ(ή|η)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex79xf, '79');
		
		const regex81xf8 = /ογδ(ο|ό)ντα ένα|ογδ(ο|ό)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex81xf8, '81');

		const regex82xf8 = /ογδ(ο|ό)ντα δύο|ογδ(ο|ό)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex82xf8, '82');

		const regex83xf8 = /ογδ(ο|ό)ντα τρία|ογδ(ο|ό)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex83xf8, '83');

		const regex84xf8 = /ογδ(ο|ό)ντα τέσσερα|ογδ(ο|ό)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex84xf8, '84');

		const regex85xf8 = /ογδ(ο|ό)ντα πέντε|ογδ(ο|ό)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex85xf8, '85');


		const regex86xf8 = /ογδ(ο|ό)ντα έξι|ογδ(ο|ό)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex86xf8, '86');

		const regex87xf8 = /ογδ(ο|ό)ντα εφτά|ογδ(ο|ό)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex87xf8, '87');

		const regex88xf8 = /ογδ(ο|ό)ντα ο(κ|χ)τώ|ογδ(ο|ό)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex88xf8, '88');


		const regex89xf8 = /ογδ(ο|ό)ντα εννιά|ογδ(ο|ό)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex89xf8, '89');
		

		const regex91xf = /ενεν(η|ή)ντα ένα|ενεν(η|ή)ντα ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex91xf, '91');

		const regex92xf = /ενεν(η|ή)ντα δύο|ενεν(η|ή)ντα δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex92xf, '92');

		const regex93xf = /ενεν(η|ή)ντα τρία|ενεν(η|ή)ντα τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex93xf, '93');

		const regex94xf = /ενεν(η|ή)ντα τέσσερα|ενεν(η|ή)ντα τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex94xf, '94');

		const regex95xf = /ενεν(η|ή)ντα πέντε|ενεν(η|ή)ντα πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex95xf, '95');


		const regex96xf = /ενεν(η|ή)ντα έξι|ενεν(η|ή)ντα εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex96xf, '96');

		const regex97xf = /ενεν(η|ή)ντα εφτά|ενεν(η|ή)ντα εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex97xf, '97');

		const regex98xf = /ενεν(η|ή)ντα ο(κ|χ)τώ|ενεν(η|ή)ντα ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex98xf, '98');


		const regex99xf = /ενεν(η|ή)ντα εννιά|ενεν(η|ή)ντα εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex99xf, '99');

		const regex101xf = /εκατ(ό|ο)ν ένα|εκατ(ό|ο)ν ενα/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex101xf, '101');

		const regex102xf = /εκατ(ό|ο)ν δύο|εκατ(ό|ο)ν δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex102xf, '102');

		const regex103xf = /εκατ(ό|ο)ν τρία|εκατ(ό|ο)ν τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex103xf, '103');

		const regex104xf = /εκατ(ό|ο)ν τέσσερα|εκατ(ό|ο)ν τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex104xf, '104');

		const regex105xf = /εκατ(ό|ο)ν πέντε|εκατ(ό|ο)ν πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex105xf, '105');


		const regex106xf = /εκατ(ό|ο)ν έξι|εκατ(ό|ο)ν εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex106xf, '106');

		const regex107xf = /εκατ(ό|ο)ν εφτά|εκατ(ό|ο)ν εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex107xf, '107');

		const regex108xf = /εκατ(ό|ο)ν ο(κ|χ)τώ|εκατ(ό|ο)ν ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex108xf, '108');


		const regex109xf = /εκατ(ό|ο)ν εννιά|εκατ(ό|ο)ν εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex109xf, '109');
		

		
		

//εξερέσεις


//110
		const regex110xf1 = /εκατ(ό|ο)ν δέκα|εκατ(ό|ο)ν δεκα/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex110xf1, '110');
//120
		const regex120xf = /εκατ(ό|ο)ν ε(ι|ί)κοσι|εκατ(ό|ο)ν ε(ι|ί)κοσι/gi;
		p=p.replace(regex120xf, '120');
//130
		const regex130xf = /εκατ(ό|ο)ν τρι(α|ά)ντα|εκατ(ό|ο)ν τρι(α|ά)ντα/gi;
		p=p.replace(regex130xf, '130');
//140
		const regex140xf = /εκατ(ό|ο)ν σαρ(α|ά)ντα|εκατ(ό|ο)ν σαρ(α|ά)ντα/gi;
		p=p.replace(regex140xf, '140');
//150
		const regex150xf = /εκατ(ό|ο)ν πεν(η|ή)ντα|εκατ(ό|ο)ν πεν(η|ή)ντα/gi;
		p=p.replace(regex150xf, '150');
//160
		const regex160xf = /εκατ(ό|ο)ν εξ(ή|η)ντα|εκατ(ό|ο)ν εξ(ή|η)ντα/gi;
		p=p.replace(regex160xf, '160');
//170
		const regex170xf = /εκατ(ό|ο)ν εβδομ(ή|η)ντα|εκατ(ό|ο)ν εβδομ(ή|η)ντα/gi;
		p=p.replace(regex170xf, '170');
//180
		const regex180xf = /εκατ(ό|ο)ν ογδ(ο|ό)ντα|εκατ(ό|ο)ν ογδ(ο|ό)ντα/gi;
		p=p.replace(regex180xf, '180');
//100
		const regex100xf = /εκατ(ό|ο)ν/gi;
		p=p.replace(regex100xf, '100');
//20
		const regex20xf = /είκοσι|εικοσι/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex20xf, '20');
//30
		const regex30xf = /τριάντα|τριαντα/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex30xf, '30');
//40

		const regex40xf = /σαράντα|σαραντα/gi;
		p=p.replace(regex40xf, '40');
//50

		const regex50xf = /πενήντα|πενηντα/gi;
		p=p.replace(regex50xf, '50');
//60
		const regex60xf = /εξήντα|εξηντα/gi;
		p=p.replace(regex60xf, '60');
//70
		const regex70xf = /εβδομ(ή|η)ντα/gi;
		p=p.replace(regex70xf, '70');
//80
		const regex80xf = /ογδ(ο|ό)ντα/gi;
		p=p.replace(regex80xf, '80');
//90
		const regex90xf = /ενεν(η|ή)ντα|ενεν(η|ή)ντα/gi;
		p=p.replace(regex90xf, '90');
//0
		const regex01xf = /μηδέν|μηδεν/gi;
		//alert(p.replace(regex81, 'one')); //να κάνουμε πρόσθεση του νούμερου ένα
		p=p.replace(regex01xf, '0');

		const regex81xf = /ένα|ενα/gi;
		p=p.replace(regex81xf, '1');

		const regex82xf = /δύο|δυο/gi;
		//alert(p.replace(regex82, 'two'));//να κάνουμε πρόσθεση του νούμερου δυο of the number two
		p=p.replace(regex82xf, '2');

		const regex83xf = /τρία|τρια/gi;
		//alert(p.replace(regex83, 'three'));//να κάνουμε πρόσθεση του νούμερου τρια
		p=p.replace(regex83xf, '3');

		const regex84xf = /τέσσερα|τεσσερα/gi;
		//alert(p.replace(regex84, 'four'));//να κάνουμε πρόσθεση του νούμερου τεσσερα
		p=p.replace(regex84xf, '4');

		const regex85xf = /πέντε|πεντε/gi;
		//alert(p.replace(regex85, 'five'));//να κάνουμε πρόσθεση του νούμερου πεντε
		p=p.replace(regex85xf, '5');


		const regex86xf = /έξι|εξι/gi;
		//alert(p.replace(regex86, 'six'));//να κάνουμε πρόσθεση του νούμερου εξι
		p=p.replace(regex86xf, '6');

		const regex87xf = /εφτά|εφτα/gi;
		//alert(p.replace(regex87, 'seven'));//να κάνουμε πρόσθεση του νούμερου εφτα
		p=p.replace(regex87xf, '7');

		const regex88xf = /ο(κ|χ)τώ|ο(κ|χ)τω/gi;
		//alert(p.replace(regex88, 'eight'));//να κάνουμε πρόσθεση του νούμερου οκτώ
		p=p.replace(regex88xf, '8');


		const regex89xf = /εννιά|εννια/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex89xf, '9');
		
		
//10
		const regex89xf1 = /δέκα|δεκα/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regex89xf1, '10');


	const regexKoMxf = /\sκόμμα\s|\sκομμα\s/gi;
		//alert(p.replace(regex89, 'nine'));//να κάνουμε πρόσθεση του νούμερου εννια
		p=p.replace(regexKoMxf, '.');


//Εξερέσεις




	$("#userInput").val(StringMathBasic(cleanString(p)));	
	
	
	
	
	
}


//Παρε την string που δημιουργείται απο το speech recognition και μετατρεψε το σε κατανοητο για την riveScript
//User main dialogue field
$('#userInput').on('click', function(e) {
/*
let regex2 = /\-/ig;

	PlusMatch = String(PlusMatch).replace(/,/g, "");
	PlusMatch = [...String(PlusMatch).replace(regex2,"minus")];
*/


	
	
	});
});

function EnterPress(e) {
    //See notes about 'which' and 'key'
    if (e.keyCode == 13) {
		window.original=$('#userInput').val();
        //var tb = document.getElementById("scriptBox");
        //eval(tb.value);
		//alert("Enter pressed="+$("#userInput").val());
			var Temp55=$('#userInput').val();
			//alert("Temp55= "+Temp55);
		if ($("#userInput").val()!=""){

			
			if(Lang=="Gre"){//Ηταν ελληνικα και ο χρήστης Έβαλε αγγλικα
			var DecRegex_2 = new RegExp(/(Please explain how much is)|(restart our lesson)|(begin again)|(my pin is)|one|two|three|four|five|six|seven|eight|nine|hard|easy|plus|and|minus|times|(multiplied by)|(divided by)|div|plus|minus|multiplication|multiply|divide|division|(random operator)|(any operator)|(do any number)/, "ig");

						if(DecRegex_2.test(Temp55)){
						Lang="Eng"
						
						sessionStorage.setItem("FromGreToEng", "true"); 
						
						//message_container.innerHTML += '<div class="bot">I must respond in english aswell!</div>';

				}
			}
			if(Lang=="Eng"){ //Ηταν αγγλικα και ο χρήστης Έβαλε ελληνικα
					var DecRegex_1 = new RegExp(/(διά το|δια το|επί το|επι το|και το|μίον το|μιον το|πλήν το|πλην το|σύν το|συν το|φορές το|φορες το|(εξ(η|ή)γησε μου π(ο|ό)σο κ(α|ά)νει το)|απ(ο|ό) την αρχ(η|ή)|π(α|ά) με π(α|ά)λι|το (πιν|pin) μου ε(ι|ί)ναι|δυσκολο|δυσκολο|εύκολο|ευκλο|όλα|ολα|εννιά|εννια|οκτώ|οκτω|οχτώ|οχτω|εφτά|εφτα|έξι|εξι|πέντε|πεντε|τέσσερα|τεσσερα|τρία|τρια|δύο|δυο|ένα|ενα|το[υ]? νο(υ|ύ)μερο[υ]?|δια(ι|ί)ρεση|δι(α|ά)|πολλαπλασιασμ(ο|ό)|επ(ι|ί)|αφα(ι|ί)ρεση|πλ(η|ή)ν|πρ(ο|ό)σθεση|σ(υ|ύ)ν|και|να κ(α|ά)νουμε|φορές|φορες|φορές το|φορες το|συν|συν το|πλην|πλην το|σύν|σύν το|πλήν|πλήν το|μίον|μίον το|μιον|μιον το|και|και το|επί|επί το|επι|επι το|διά|διά το|δια|δια το)/, "ig");
					if(DecRegex_1.test(Temp55)){
						
						Lang="Gre"
						sessionStorage.setItem("FromEngToGre", "true"); 
						
						//message_container.innerHTML += '<div class="bot">θα σου απαντήσω στα ελληνικά και εγώ!</div>';
					}
			}
			if(Lang=="Eng"){	
					var DecRegex = new RegExp(/[+-]?([0-9]*[.])?[0-9]+ (plus|and|minus|times|multiplied by|divided by|div) [+-]?([0-9]*[.])?[0-9]+/, "ig");

						if(DecRegex.test(Temp55)){
								
							//alert("Bravooooooo"); //5 p 4 plus 6 p 8 
							//5.4 και 6.8
							
							//Temp55 = String(Temp55).replace(/\./g, " p ");
							
							//alert("StrT= "+Temp55);
							
						}
						
						
						TextProcess(Temp55,$wasRec);
					}
				
				if(Lang=="Gre"){
					
					
					
					
					//alert("this was Gre");
					GreekTxtProcess($('#userInput').val());
				}
			
			return true;
		
		}else{
		
			return false;
		}
		
		
	}
    
}

	</script>
	
  </head>
  <body>

  
  
  
    <div class="chat" id="chat">
      <div class="messages"></div>
      <div id="edge"></div>
 
    </div>
	<form class="actions"> <!-- value="wdww one thousand three hundred thirty five point eight five four one thousand two hundred fourty five ghfghf plus one thousand three hundred thirty five ghfghf point nine thirty six ghf"-->
        <input id="userInput" type="text" title="press Enter to send..." onKeyPress="return EnterPress(event);" value="">
		<input id="voiceInput" type="button" >
		<input id="Synth" type="button" >
      </form>    
    <script src="https://unpkg.com/rivescript@latest/dist/rivescript.min.js"></script>
	<script src="chatbot/script.js"></script>
  </body>
</html>
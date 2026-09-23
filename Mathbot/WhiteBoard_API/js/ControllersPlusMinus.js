$(function() {
window.pre_NumA=0;
window.pre_NumB=0;
	
		document.getElementById("CountinBallz").style.visibility = "hidden";
		document.getElementById("root_cont").style.visibility = "hidden";
	// Number A textbox
	$("#NumberA").focusout(function() {//Set value of variable for NumA
		pre_NumA=this.value;
		/*if(sessionStorage.getItem("CaLLNumA")===null || sessionStorage.getItem("CaLLOper")===null || sessionStorage.getItem("CaLLNumB")===null){
			alert("SESSION numA= is null "+sessionStorage.getItem("CaLLNumA"));
			
		}else{
			alert("SESSION numA= "+sessionStorage.getItem("CaLLNumA"));
			alert("SESSION Oper= "+sessionStorage.getItem("CaLLOper"));
			alert("SESSION numB= "+sessionStorage.getItem("CaLLNumB"));
		}*/
	});
	// Number B textbox
	$("#NumberB").focusout(function() { //Set value of variable for NumB
		pre_NumB=this.value;
	});
	//Initially hide these
	$("#main_Multi").hide(); 	 //multi
	$("#main_Divi").hide();		 //divi	
	
	// Select operator switch-button
window.oper="plus";
	$("#oper").click(function(){
		document.getElementById("CountinBallz").style.visibility = "hidden";
		document.getElementById("root_cont").style.visibility = "hidden";
	$("#Ais .CountinBallz span").text( "" );
	$("#Ais .CountinBallz span").text( "" );
	$("#Bis .CountinBallz span").text( "" );	
	$(".Kratu span").text( "" );
	$(".Total span").text( "" );
	$(".Rdown span").text( "" );

		if(Lang=="Eng"){
		$("#Instructions").html(
			"<h4>Click something,Make magic!</h4>"
			);
		}
		if(Lang=="Gre"){
		$("#Instructions").html(
			"<h4>Πάτησε κάτι να αποκαλύψεις το μυστικο μου!</h4>"
			);
		}
		console.log("NumberA= "+pre_NumA +" and NumberB = "+ pre_NumB);

		if(this.value=="+"){
			this.value="-";
			oper="minus";
			$("#operIcon b").text("-");
			$("#main_PlusMinus").show(); //plus
			$("#main_Multi").hide(); 	 //multi
			
			$("#main_Divi").hide();		 //divi	
			
			
		}else if(this.value=="-"){
			this.value="x";
			oper="multy";
			$("#main_PlusMinus").hide(); //plus
			$("#main_Multi").show(); 	 //multi
			$("#main_Divi").hide(); 	 //divi	
		}else if(this.value=="x"){
			this.value="/";
			$("#operIcon b").text("/");
			oper="divy";
			$("#main_PlusMinus").hide();  //plus
			$("#main_Multi").hide(); 	  //multi
			$("#main_Divi").show(); 	  //divi	
			
			
		}else if(this.value=="/"){
			this.value="+";
			oper="plus";
			$("#operIcon b").text("+");
			$("#main_PlusMinus").show(); //plus
			$("#main_Multi").hide(); 	 //multi
			$("#main_Divi").hide();		 //divi	
		}
	});
//Super-Global to LOAD THE WHITEBOARD with the UserMistake clicked by the user from the UserMistakes log!
window.SetMissVals=function(numA,oper2, numB){
    //do something here 
$("#Ais .CountinBallz span").text( "" );
$("#Bis .CountinBallz span").text( "" );	
	$(".Kratu span").text( "" );
	$(".Total span").text( "" );
	$(".Rdown span").text( "" );
	
	
	//alert("Call from another file!");
	pre_NumA=String(numA);
	oper=oper2;
	pre_NumB=String(numB);
	
	$("#NumberA").val(""+pre_NumA);
	$("#NumberB").val(""+pre_NumB);
	
		if(oper=="minus"){
			$("#oper").val("-");
			$("#operIcon b").text("-");
			$("#main_PlusMinus").show(); //plus
			$("#main_Multi").hide(); 	 //multi
			
			$("#main_Divi").hide();		 //divi	
			
			
		}else if(oper=="multy"){
			$("#oper").val("x");
			oper="multy";
			$("#main_PlusMinus").hide(); //plus
			$("#main_Multi").show(); 	 //multi
			$("#main_Divi").hide(); 	 //divi	
		}else if(oper=="divy"){
			$("#oper").val("/");
			$("#operIcon b").text("/");
			
			$("#main_PlusMinus").hide();  //plus
			$("#main_Multi").hide(); 	  //multi
			$("#main_Divi").show(); 	  //divi	
			
			
		}else if(oper=="plus"){
			$("#oper").val("+");
			$("#operIcon b").text("+");
			$("#main_PlusMinus").show(); //plus
			$("#main_Multi").hide(); 	 //multi
			$("#main_Divi").hide();		 //divi	
		}
	
	WhiteboardIni();
};

	$("#btn_Start").click(function(){
		
 if(Lang=="Eng"){
		if(pre_NumA==""){
			
			alert("Type a number for A please...");
			return;
		}
		if(pre_NumB==""){
			
			alert("Type a number for B please...");
			return;
		}
 }
 if(Lang=="Gre"){
		if(pre_NumA==""){
			
			alert("Γράψε κάτι στον αριθμό Α παρακαλώ...");
			return;
		}
		if(pre_NumB==""){
			
			alert("Γράψε κάτι στον αριθμό Β παρακαλώ...");
			return;
		}
 }
		WhiteboardIni();
$("#Ais .CountinBallz span").text( "" );
$("#Bis .CountinBallz span").text( "" );	
	$(".Kratu span").text( "" );
	$(".Total span").text( "" );
	$(".Rdown span").text( "" );	
	});
	//Run the WHITEBOARD with the values as loaded!
	function WhiteboardIni(){
		
		if(Lang=="Eng"){
		$("#Instructions").html(
			"<h4>Click something,Make magic!</h4>"
			);
		}
		if(Lang=="Gre"){
		$("#Instructions").html(
			"<h4>Πάτησε κάτι να αποκαλύψεις το μυστικο μου!</h4>"
			);
		}
		PointAlignA = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
		PointAlignB = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
		// Και οι δυο Α και Β να ειναι δεκαδικοι!
			if(PointAlignA.test(pre_NumA)){
				var strPreA1= pre_NumA.substr(0,String(pre_NumA).indexOf('.')); 
				var strPreA2= pre_NumA.substr(String(pre_NumA).indexOf('.'),);
			}else{ //Ακεραιο
				strPreA1 = pre_NumA;
				strPreA2 = "";
				
			}		
			console.log("strPreA1= "+strPreA1);
			console.log("strPreA2= "+strPreA2);
			if(PointAlignB.test(pre_NumB)){
				var strPreB1= pre_NumB.substr(0,String(pre_NumB).indexOf('.')); 
				var strPreB2= pre_NumB.substr(String(pre_NumB).indexOf('.'),); 
			}else{
				strPreB1 = pre_NumB;
				strPreB2 = "";
				
			}
			console.log("strPreB1= "+strPreB1);
			console.log("strPreB2= "+strPreB2);
			document.getElementById("root_cont").style.visibility = "visible";
			if(oper=="plus" || oper=="minus"){
				padPM(strPreA1,strPreA2,strPreB1,strPreB2,oper); //PlusMinus
			}else if(oper=="multy"){
				var MultiRes=0;
				MultiRes = new Big(MultiRes);
				MultiRes = MultiRes.plus(pre_NumA).times(pre_NumB);
				
				padMulty(strPreA1,strPreA2,strPreB1,strPreB2,oper,MultiRes);
			}else if(oper=="divy"){
				padDivy(strPreA1,strPreA2,strPreB1,strPreB2,oper);
			}
		
	}
	
	/////90789898978978978978
	
	
	let Fixed_NumA;
	let Fixed_NumB;
	
	var steps=0;
	var stepA=0;
	var stepB=0;
	var stepC=0;
	//pad leading zeroes to number for PLUS-MINUS
	function padPM(a1, a2, b1, b2,oper) {
		

		$("#CountinBallz").css("visibility","hidden");
		
		
	var Fixed_NumC=0;
	//Fix --> b1
		if(a1.length>b1.length){  
			var s1 = b1+"";
			while (s1.length < a1.length) s1 = "0" + s1;
		}else{
			s1 = b1;
		}
	//Fix --> b2
		if(a2.length>b2.length){
			if(b2.length==0){
				var s2 = b2+".";
				while (s2.length < a2.length) s2 = s2+"0";
			}else{
				var s2 = b2+"";
				while (s2.length < a2.length) s2 = s2+"0";
			}
		}else{
			s2 = b2;
		}
	//Fix --> a1
		if(a1.length<b1.length){
			var s3 = a1+"";
			while (s3.length < b1.length) s3 = "0" + s3;
		}else{
			s3 = a1;
		}
	//Fix --> a2
		if(b2.length>a2.length){
			//If only the B number has decimals 
			if(a2.length==0){ 
			var s4 = a2+".";
			while (s4.length < b2.length) s4 = s4+"0";
			}else{
			var s4 = a2+"";
			while (s4.length < b2.length) s4 = s4+"0";	
			}

		}else{
			s4 = a2;
		}
			Fixed_NumA = (s3+""+s4);
			Fixed_NumB = (s1+""+s2);
			
			//Use Big() to fix decimal precision
			Fixed_NumC = new Big(Fixed_NumC)
			
			if(oper=="plus"){
				//alert("Fixed_NumA= "+Fixed_NumA);
				//alert("Fixed_NumB= "+Fixed_NumB);
				Fixed_NumC = Fixed_NumC.plus(Fixed_NumA).plus(Fixed_NumB);
				
			}else if(oper=="minus"){
				//alert("BIG NUMBER_A : Fixed_NumA= "+Fixed_NumA);
				//alert("BIG NUMBER_B : Fixed_NumB= "+Fixed_NumB);
				//alert("BIG NUMBER_C : Fixed_NumC= "+Fixed_NumC);
				//Fixed_NumC = Math.abs(Fixed_NumC.plus(Fixed_NumA).minus(Fixed_NumB));	
				
			if(Fixed_NumA>Fixed_NumB){
				
				Fixed_NumC =Fixed_NumC.plus(Fixed_NumA).minus(Fixed_NumB);	
			//alert("BIG NUMBER_C : 22 Fixed_NumC= "+Fixed_NumC);				
				
			}
			if(Fixed_NumA<Fixed_NumB){
				
				Fixed_NumC =Fixed_NumC.plus(Fixed_NumB).minus(Fixed_NumA);	
			//alert("BIG NUMBER_C : 11 Fixed_NumC= "+Fixed_NumC);					
				
			}


			}


		//Olso fix the result C numbers to as many leading and preceding zeroes
		let PointAlignC;	
		PointAlignC = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
		//Περιπτωση  ο NumbC να ειναι δεκαδικος
		if(PointAlignC.test(Fixed_NumC)){ 
		
			var strPreC1= String(Fixed_NumC).substr(0,String(Fixed_NumC).indexOf('.')); 
			var strPreC2= String(Fixed_NumC).substr(String(Fixed_NumC).indexOf('.'),); 
			if(strPreC1.length>a1.length){ //CASE NUMBER_C IS LARGER
			//alert("CASE NUMBER_C IS LARGER: Fixed_NumC= "+Fixed_NumC);
				while (s3.length < strPreC1.length) s3 = "0" + s3;
				while (s1.length < strPreC1.length) s1 = "0" + s1;
				Fixed_NumA = (s3+""+s4);
				Fixed_NumB = (s1+""+s2);
				
				$("#main_A").text(s3+""+s4);
				$("#main_B").text(s1+""+s2);
				$("#result").text(Fixed_NumC);
			
			
			
			}else{ //Number_C IS SMALLER
			//alert("Number_C IS SMALLER: Fixed_NumC= "+Fixed_NumC);
				while (s3.length < strPreC1.length) s3 = "0" + s3;
				while (s1.length < strPreC1.length) s1 = "0" + s1;
				Fixed_NumA = (s3+""+s4);
				Fixed_NumB = (s1+""+s2);
				
			 
				var strPreC1= String(Fixed_NumC).substr(0,String(Fixed_NumC).indexOf('.')); 
				var strPreC2= String(Fixed_NumC).substr(String(Fixed_NumC).indexOf('.'),);
				
				
				//Add zeroes to C if was smaller 300-210=90 make it to 300-210=090
				var s5 = strPreC1+"";
				while (a1.length > s5.length) s5 = "0"+s5;	
				var s6 = strPreC2+"";
				while (a2.length > s6.length) s6 = s6+"0";	
				
				$("#main_A").text(s3+""+s4);
				$("#main_B").text(s1+""+s2);
				$("#result").text(s5+""+s6);
				
				
			}
			
			
			
			//Περιπτωση  ο NumbC να ειναι ακεραιος
		}else{ //ακεραιος

			if(String(Fixed_NumC).length>a1.length){

				while (s3.length < String(Fixed_NumC).length) s3 = "0" + s3;
				while (s1.length < String(Fixed_NumC).length) s1 = "0" + s1;
				Fixed_NumA = (s3+""+s4);
				Fixed_NumB = (s1+""+s2);
				
			}
			//Fix leading zeroes missing from numberC
			if(String(Fixed_NumC).length<a1.length){
				
				while (a1.length > String(Fixed_NumC).length) Fixed_NumC = "0" + Fixed_NumC;
				
				
			}
		//alert("ακεραιος: Fixed_NumC= "+Fixed_NumC);
			$("#main_A").text(s3+""+s4);
			$("#main_B").text(s1+""+s2);
			$("#result").text(Fixed_NumC);
		}
		//Move-buttons variables	
			steps= String(Fixed_NumA).length-1;
			stepA=steps;
			stepB=steps;
			stepC=steps;
		}// pad()
		



//Load Ballz ini

//AisCount=Str_A.charAt(stepA+1);
//CalcTotalBallz();


//Move-button for step-back
	let wasEdge;
	let wasBack;
$("#StepBack").click(function(){
	wasBack=true;

	if(wasEdge){
		wasEdge=false;
		
		if(wasAhead){
			wasAhead=false;
		stepA=stepA+1;
		stepB=stepB+1;
		stepC=stepC+1;
		}
	}else{
		if(wasAhead){
			wasAhead=false;
		stepA=stepA+2;
		stepB=stepB+2;
		stepC=stepC+2;
		}	
		
		
	}
	var Str_A= $("#main_A").text();
	var Str_B= $("#main_B").text();
	var Str_C= $("#result").text();
	
	// A
	if(Str_A.charAt(stepA)=="."){
		//stepA=stepA+1;
		
		//Ballz
		AisCount=Number(Str_A.charAt(stepA+1));
		
		var col_A=Str_A.slice(0,stepA+1)+"<span style='color:red;'>" +Str_A.charAt(stepA+1)+"</span>"+Str_A.slice(stepA+2);
	}else{

		//Ballz
		AisCount=Number(Str_A.charAt(stepA));
		
		var col_A=Str_A.slice(0,stepA)+"<span style='color:red;'>"+Str_A.charAt(stepA)+"</span>"+Str_A.slice(stepA+1);	

		}
	// B
	if(Str_B.charAt(stepB)=="."){
		//stepB=stepB+1;
		//Ballz
		BisCount=Number(Str_B.charAt(stepB+1));
		
		var col_B=Str_B.slice(0,stepB+1)+"<span style='color:red;'>"+Str_B.charAt(stepB+1)+"</span>"+Str_B.slice(stepB+2);
	}else{
		
		//Ballz
		BisCount=Number(Str_B.charAt(stepB));
		
		var col_B=Str_B.slice(0,stepB)+"<span style='color:red;'>"+Str_B.charAt(stepB)+"</span>"+Str_B.slice(stepB+1);			
	}
	// C
	if(Str_C.charAt(stepC)=="."){
		//stepC=stepC+1;
		var col_C=Str_C.slice(0,stepC+1)+"<span style='color:red;'>"+ Str_C.charAt(stepC+1)+"</span>"+Str_C.slice(stepC+2);
	}else{
		var col_C=Str_C.slice(0,stepC)+"<span style='color:red;'>"+Str_C.charAt(stepC)+"</span>"+Str_C.slice(stepC+1);	
	}
	//alert("AisCount= "+AisCount);
	//alert("BisCount= "+BisCount);
	CalcTotalBallz();
	if(Lang=="Eng"){
		if(oper=="plus"){
			$("#Instructions").html(
				"Add to the number <b class='Red'>"+ Str_A.charAt(stepA)+"</b> which is part of number A:"+Str_A+", the number <b class='Red'>"+Str_B.charAt(stepB)+"</b> which is part of number B,"
				+"<br><hr>then if the result is lartger than <u>9</u> place the last digit bellow like: <b class='Red'>"+Str_C.charAt(stepC)+"</b> and save the second digit as carry,"
				+"<br><hr>then add the carry to the next sub-total of the next two portions of the numbers A and B waiting to be added next and repeat"
				);
		}else{
			$("#Instructions").html(
				"Subtract from the number <b class='Red'>"+ Str_A.charAt(stepA)+"</b> which part of number A:"+Str_A+", the number <b class='Red'>"+Str_B.charAt(stepB)+"</b> which is part of number B,"
				+"<br><hr>then if the result is less than <u>0</u> borrow 1 from the next number in line, add 10 to the number taken from A then subtract normally"
				+"<br><hr>write the result as number C:<b class='Red'>"+Str_C.charAt(stepC)+"</b> remember to perform <b>minus 1</b> on the next number from A"
				+"<br><hr>olso if the Number B is larget than number A then you must subtract number A from number B in reverse-like order"
				);	
		}
	}
	if(Lang=="Gre"){
		if(oper=="plus"){
			$("#Instructions").html(
				"Πρόσθεσε στον <b class='Red'>"+ Str_A.charAt(stepA)+"</b> που είναι μέρος του αριθμού A:"+Str_A+", τον αριθμό <b class='Red'>"+Str_B.charAt(stepB)+"</b> που είναι μέρος του αριθμού B,"
				+"<br><hr>και τότε, αν το αποτέλεσμα είναι μεγαλύτερο από το <u>9</u> τοποθέτησε τις μονάδες εδώ έτσι: <b class='Red'>"+Str_C.charAt(stepC)+"</b> και οι δεκάδες θα είναι το κρατούμενο,"
				+"<br><hr>τότε προσθέσε το κρατούμενο στον επόμενο αριθμό του αριθμού Α και συνέχισε"
				);
		}else{
			$("#Instructions").html(
				"Αφαίρεσε από τον αριθμό <b class='Red'>"+ Str_A.charAt(stepA)+"</b> που είναι μέρος του αριθμού Α:"+Str_A+", τον αριθμό <b class='Red'>"+Str_B.charAt(stepB)+"</b> που είναι μέρος του αριθμού Β,"
				+"<br><hr>αν το αποτέλεσμα είναι μικρότερο του <u>0</u> δανείσου ένα απο τον αμέσος επόμενο αριθμό, τώρα πρόσθεσε δέκα στον αριθμό απο τον αριθμό Α και αφαίρεσε κανονικά"
				+"<br><hr>το αποτέλεσμα θα είναι του αριθμού C:<b class='Red'>"+Str_C.charAt(stepC)+"</b> πρέπει να κάνεις  <b>μίον 1</b> από τον επόμενο αριθμό του Α"
				+"<br><hr>Προσωχή αν ο αριθμός Β είναι μεγαλύτερος απο τον Α η αφαίρεση θα γίνει από τον Β θα αφαιρέσεις τον Α"
				);	
		}
	}
	$("#main_A").html(col_A);
	$("#main_B").html(col_B);
	$("#result").html(col_C);
	if(stepA>=steps){
		wasEdge=true;
	}else{
		stepA=stepA+1;
		stepB=stepB+1;
		stepC=stepC+1;
	}
	
});
//Move-button for step-Ahead
let wasAhead;
$("#StepAhead").click(function(){
//------
	wasAhead=true;
//-----

	if(wasEdge){
		wasEdge=false;
		
		if(wasBack){
			wasBack=false;
		stepA=stepA-1;
		stepB=stepB-1;
		stepC=stepC-1;
		}
	}else{
		if(wasBack){
			wasBack=false;
		stepA=stepA-2;
		stepB=stepB-2;
		stepC=stepC-2;
		}	
		
		
	}	
	
	var Str_A= $("#main_A").text();
	var Str_B= $("#main_B").text();
	var Str_C= $("#result").text();
	// A
	if(Str_A.charAt(stepA)=="."){
		stepA=stepA-1;
		
		//Ballz
		AisCount=Number(Str_A.charAt(stepA));
		
		var col_A=Str_A.slice(0,stepA)+"<span style='color:red;'>"+Str_A.charAt(stepA) +"</span>"+Str_A.slice(stepA+1);
	}else{
		
		//Ballz
		AisCount=Number(Str_A.charAt(stepA));
		var col_A=Str_A.slice(0,stepA)+"<span style='color:red;'>"+Str_A.charAt(stepA)+"</span>"+Str_A.slice(stepA+1);	}
	// B
	if(Str_B.charAt(stepB)=="."){
		stepB=stepB-1;
		
		//Ballz
		BisCount=Number(Str_B.charAt(stepB));
		
		var col_B=Str_B.slice(0,stepB)+"<span style='color:red;'>"+Str_B.charAt(stepB) + "</span>"+Str_B.slice(stepB+1);
	}else{
		
		//Ballz
		BisCount=Number(Str_B.charAt(stepB));
		
		var col_B=Str_B.slice(0,stepB)+"<span style='color:red;'>"+Str_B.charAt(stepB)+"</span>"+Str_B.slice(stepB+1);			
	}
	// C
	if(Str_C.charAt(stepC)=="."){
		stepC=stepC-1;
		var col_C=Str_C.slice(0,stepC)+"<span style='color:red;'>"+Str_C.charAt(stepC) + "</span>"+Str_C.slice(stepC+1);
	}else{
		var col_C=Str_C.slice(0,stepC)+"<span style='color:red;'>"+Str_C.charAt(stepC)+"</span>"+Str_C.slice(stepC+1);	
	}	
	$("#main_A").html(col_A);
	$("#main_B").html(col_B);
	$("#result").html(col_C);
	//alert("AisCount= "+AisCount);
	//alert("BisCount= "+BisCount);
	CalcTotalBallz();

	if(Lang=="Eng"){
		if(oper=="plus"){
			$("#Instructions").html(
				"Add to the number <b class='Red'>"+ Str_A.charAt(stepA)+"</b> which is part of number A:"+Str_A+", the number <b class='Red'>"+Str_B.charAt(stepB)+"</b> which is part of number B,"
				+"<br><hr>then if the result is lartger than <u>9</u> place the last digit bellow like: <b class='Red'>"+Str_C.charAt(stepC)+"</b> and save the second digit as carry,"
				+"<br><hr>then add the carry to the next sub-total of the next two portions of the numbers A and B waiting to be added next and repeat"
				);
		}else{
			$("#Instructions").html(
				"Subtract from the number <b class='Red'>"+ Str_A.charAt(stepA)+"</b> which part of number A:"+Str_A+", the number <b class='Red'>"+Str_B.charAt(stepB)+"</b> which is part of number B,"
				+"<br><hr>then if the result is less than <u>0</u> borrow 1 from the next number in line, add 10 to the number taken from A then subtract normally"
				+"<br><hr>write the result as number C:<b class='Red'>"+Str_C.charAt(stepC)+"</b> remember to perform <b>minus 1</b> on the next number from A"
				+"<br><hr>olso if the Number B is larget than number A then you must subtract number A from number B in reverse-like order"
				);	
		}
	}
	if(Lang=="Gre"){
		if(oper=="plus"){
			$("#Instructions").html(
				"Πρόσθεσε στον <b class='Red'>"+ Str_A.charAt(stepA)+"</b> που είναι μέρος του αριθμού A:"+Str_A+", τον αριθμό <b class='Red'>"+Str_B.charAt(stepB)+"</b> που είναι μέρος του αριθμού B,"
				+"<br><hr>και τότε, αν το αποτέλεσμα είναι μεγαλύτερο από το <u>9</u> τοποθέτησε τις μονάδες εδώ έτσι: <b class='Red'>"+Str_C.charAt(stepC)+"</b> και οι δεκάδες θα είναι το κρατούμενο,"
				+"<br><hr>τότε προσθέσε το κρατούμενο στον επόμενο αριθμό του αριθμού Α και συνέχισε"
				);
		}else{
			$("#Instructions").html(
				"Αφαίρεσε από τον αριθμό <b class='Red'>"+ Str_A.charAt(stepA)+"</b> που είναι μέρος του αριθμού Α:"+Str_A+", τον αριθμό <b class='Red'>"+Str_B.charAt(stepB)+"</b> που είναι μέρος του αριθμού Β,"
				+"<br><hr>αν το αποτέλεσμα είναι μικρότερο του <u>0</u> δανείσου ένα απο τον αμέσος επόμενο αριθμό, τώρα πρόσθεσε δέκα στον αριθμό απο τον αριθμό Α και αφαίρεσε κανονικά"
				+"<br><hr>το αποτέλεσμα θα είναι του αριθμού C:<b class='Red'>"+Str_C.charAt(stepC)+"</b> πρέπει να κάνεις  <b>μίον 1</b> από τον επόμενο αριθμό του Α"
				+"<br><hr>Προσωχή αν ο αριθμός Β είναι μεγαλύτερος απο τον Α η αφαίρεση θα γίνει από τον Β θα αφαιρέσεις τον Α"
				);	
		}
	}
		
	if(stepA<=0){
		wasEdge=true;
	}else{
		stepA=stepA-1;
		stepB=stepB-1;
		stepC=stepC-1;
	}
	

	
	
	
	
});





	
	
	
});//ready
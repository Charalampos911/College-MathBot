
 
var MediumX=0;
var M=0;

	var steps=0;
	var stepAhead=0;
	var stepBack=0;

var Digits_B = [];
function padMulty(a1, a2, b1, b2,oper,Result) {
	document.getElementById("StepBackM1").disabled = true;
	Digits_B=[];
	M=0;
	$( "#MultRes" ).html("");
	//Fix --> b1
		if(a1.length>b1.length){  
			var s1 = b1+"";
			while (s1.length < a1.length) s1 = "0" + s1;
		}else{
			s1 = b1;
		}
	//alert("a2= "+a2);
	//alert("b2= "+b2);
	//Fix --> b2
		if(a2.length>b2.length && b2!=""){
			if(b2.length==0){
				var s2 = b2+".";
				while (s2.length < a2.length) s2 = s2+"0";
			}else{
				var s2 = b2+"";
				while (s2.length < a2.length) s2 = s2+"0";
			}
		}else{
			//alert("No b2");
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

	
		if(b2.length>a2.length&& a2!=""){
			//If only the B number has decimals 
			if(a2.length==0){ 
			var s4 = a2+".";
			while (s4.length < b2.length) s4 = s4+"0";
			}else{
			var s4 = a2+"";
			while (s4.length < b2.length) s4 = s4+"0";	
			}

		}else{
			//alert("No a2");
			s4 = a2;
		}
			Fixed_NumA = (s3+""+s4);
			Fixed_NumB = (s1+""+s2);
			//alert("Fixed_NumA= "+Fixed_NumA);
			//alert("Fixed_NumB= "+Fixed_NumB);
var numberB = Number(Fixed_NumB);



//Figure where the comma is at, if any 
var sNumber = numberB.toString(),
	DigitsLengthA=0,
	DigitsLengthB=0;
for (var i = 0, len = sNumber.length; i < len; i += 1) {
	if(sNumber.charAt(i)=="."){
		
		//console.log("comma at= "+i);
		var CommaCount=true;
	}else{
		if(CommaCount){ 
			DigitsLengthB+=1;
			
		}else{
			DigitsLengthA+=1;
		}
		//console.log("NumberB at= "+i+" -> sNumber.charAt(i)==="+sNumber.charAt(i));
		Digits_B.push(+sNumber.charAt(i));
	}
	//console.log("DigitsLengthB= "+DigitsLengthB);
}
CommaCount=false;

//console.log("Digits_B= "+Digits_B);
	$("#main_A2").text(Fixed_NumA);
	$("#main_B2").text(Fixed_NumB);
	//$("#result").text(Fixed_NumC);
	
var numberA = Number(Fixed_NumA);		
	var t1 = 0;
	var t2 = 0;
	//Load the C1: C2: C3: etc numbers
for (var i = Digits_B.length-1, len = 0; i >= len; i -= 1) {	
	if(Number(DigitsLengthB)-t2<=0){
		var k = bigCalc1(numberA,Digits_B[i]);
		t1=t1+1;
		t2=t2+1; //for C1: C2: etc
		MediumX=0;
	//console.log("Digits_B  X  numberA =="+  Digits_B[i]+" x "+ numberA +" => "+ k);
		$( "#MultRes" ).append( "<label>&nbsp;C"+t2+": </label><span class='CMedium'>"+k+"</span><br>" );
		
	}else {
		var k = bigCalc2(numberA,Digits_B[i],Number(DigitsLengthB)-t2);
		t2=t2+1;
		MediumX=0;
	//console.log("Digits_B  X  numberA =="+  Digits_B[i]+" x "+ numberA +" => "+ k);
		$( "#MultRes" ).append( "<label>&nbsp;C"+t2+": </label><span class='CMedium'>"+k+"</span><br>" );
		
	}

    
}
t1 = 0;	
t2 = 0;	
DigitsLengthB=0;
alignResults(Result);

	//Restore other steps variables
	steps= $("#result2").text().length-1;
	wasBackAdd=false;
	stepAhead=0;
	wasAheadAdd=false

	//restore other buttons variables
		wasAhead1=false;
		wasBack1=false;
		stepAhead1=1;
		ThisC=0;
		isMax=false;
		isDot=false;


}//pad
	var Process_C = [];
	var Process_C2 = [""];
	var removeDots=false;
	var Mdot="."; 
	//Add leading and preceding zeroes to everything, in order to alighn them all vertically
function alignResults(Result){
	var N_A = $("#main_A2").text();
	var N_B =$("#main_B2").text();
	
	PointAlignB25 = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
	PointAlignB26 = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
	//alert("N_A="+N_A);alert("N_B="+N_B);
	removeDots=false;
	//alert("N_A= "+N_A);
	//alert("N_B= "+N_B);
	var N_ADot=0;
	var N_BDot=0;
	N_ADot=0; N_BDot=0;
if(PointAlignB25.test(N_A)){
	//alert("N_A  have dots");
	N_ADot=1;
}
if(PointAlignB26.test(N_B)){
	N_BDot=1;	
		
		
		//alert("N_B have dots");
}
removeDots=false;
if(N_ADot==1 || N_BDot==1 ){
	
	//alert("N_ADot N_BDot have dots ==1");
	removeDots=false;
	N_ADot=0; N_BDot=0;
}else{
	removeDots=true;
	N_ADot=0; N_BDot=0;
	//alert("Neither have Dots");
	
}

/*	}else{
		removeDots=true;
		
	}*/
	
	
	
	
	//console.log("N_A="+N_A);
	//console.log("N_B="+N_B);
  var x = document.getElementsByClassName("CMedium");


	//console.log("x.length= "+ x.length);

	Process_C.push(+Number(N_A));
	Process_C.push(+Number(N_B));
for (var i = 0, len = x.length; i < len; i += 1) {
	
	Process_C.push(+x[i].innerText);
}
//console.log(Process_C);
//console.log("Process_C.length= "+Process_C.length);
var Alen=0;
var Blen=0;
// Get the lengthiest decimal
for (var j = 0, len = Process_C.length; j < len; j += 1) {
PointAlignB = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
	if(PointAlignB.test(Process_C[j])){
		var Temp_1= String(Process_C[j]).substr(0,String(Process_C[j]).indexOf('.')); 
		var Temp_2= String(Process_C[j]).substr(String(Process_C[j]).indexOf('.'),).split('.').join("");
		if(Temp_1.length>Alen){
			Alen=Temp_1.length;
			//console.log("Alen= "+Alen);
		}
		if(Temp_2.length>Blen){
			Blen=Temp_2.length;
			//console.log("Blen= "+Blen);
		}
	}else{ //Ακεραιο
		var Temp_1 = String(Process_C[j]);
		var Temp_2 = "";
		if(Temp_1.length>Alen){
			Alen=Temp_1.length;
			//console.log("Alen= "+Alen);
		}
		
	}
}//for
// Now add the zeroes to the numbers to align them

for (var j = 0, len = Process_C.length; j < len; j += 1) {
PointAlignB2 = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
	if(PointAlignB2.test(Process_C[j])){
		var Temp_1= String(Process_C[j]).substr(0,String(Process_C[j]).indexOf('.')); 
		var Temp_2= String(Process_C[j]).substr(String(Process_C[j]).indexOf('.'),).split('.').join("");
		
		//Fix Temp_1
			var T1 = Temp_1+"";
			var Ζ1 = "";
			while (T1.length < Alen) {
			Ζ1 = "0"+Ζ1;
			T1 = "0"+T1;
			
			}
		//console.log("xaxaXAXA T1= "+T1);

		//Fix Temp_2
			var T2 = Temp_2+"";
			var Ζ2 = "";
			while (T2.length < Blen){
				Ζ2 = "0"+Ζ2;
				T2 = T2+"0";
				 
			}
		//console.log("xaxaXAXA T2= "+T2);
		if(j==0){
			//alert("Temp_2 11111= "+Temp_2);
			$("#main_A2").html(Ζ1 +"<em class='Grey'>"+ Temp_1+"."+Temp_2+"</em>"+Ζ2);
			
			
		}else if(j==1){
			//alert("Temp_2 22222= "+Temp_2);
			$("#main_B2").html(Ζ1 +"<em class='Grey'>"+ Temp_1+"."+Temp_2+"</em>"+Ζ2);	
		}else{
			
			x[j-2].innerHTML=Ζ1 +"<span class='Grey'>"+ Temp_1+"."+Temp_2+"</span>"+Ζ2;
			
		}


	}else{ //Ακεραιο
		var Temp_1= String(Process_C[j]); 
		var Temp_2= "";
		
		//Fix Temp_1
			var T1 = Temp_1+"";
			var Ζ1 = "";
			while (T1.length < Alen) {
			Ζ1 = "0"+Ζ1;
			T1 = "0"+T1;
			
			}
		//console.log("xaxaXAXA T1= "+T1);

		//Fix Temp_2
			var T2 = Temp_2+"";
			var Ζ2 = "";
			while (T2.length < Blen){
				Ζ2 = "0"+Ζ2;
				T2 = T2+"0";
				 
			}
		//console.log("xaxaXAXA T2= "+T2);
		if(j==0){
			//alert("Temp_2 11111= "+Temp_2);
			if(Temp_2==""){
				
				if(removeDots){
					
					
					//alert("is dots 111");
					$str5 =Ζ1 +"<em class='Grey'>"+ Temp_1+"</em>."+Temp_2+""+Ζ2;
					$("#main_A2").html($str5.split('.').join(""));	
				}else{
					$("#main_A2").html(Ζ1 +"<em class='Grey'>"+ Temp_1+"</em>."+Temp_2+""+Ζ2);	
				}
			}else{
				$("#main_A2").html(Ζ1 +"<em class='Grey'>"+ Temp_1+"."+Temp_2+"</em>"+Ζ2);
			}
			
		}else if(j==1){
			//alert("Temp_2 22222= "+Temp_2);
			if(Temp_2==""){
				if(removeDots){
					//alert("is dots 222");
					$str5 =Ζ1 +"<em class='Grey'>"+ Temp_1+"</em>."+Temp_2+""+Ζ2;
					$("#main_B2").html($str5.split('.').join(""));	
				}else{
					$("#main_B2").html(Ζ1 +"<em class='Grey'>"+ Temp_1+"</em>."+Temp_2+""+Ζ2);	
				}
			}else{
				$("#main_B2").html(Ζ1 +"<em class='Grey'>"+ Temp_1+"."+Temp_2+"</em>"+Ζ2);
			}	
		}else{
			if(Temp_2==""){
				if(removeDots){
				$str5 = Ζ1 +"<span class='Grey'>"+ Temp_1+"</span>."+Temp_2+""+Ζ2;
				x[j-2].innerHTML=$str5.split('.').join("");;
				
				}else{
					x[j-2].innerHTML=Ζ1 +"<span class='Grey'>"+ Temp_1+"</span>."+Temp_2+""+Ζ2;
					
				}
			}else{
				x[j-2].innerHTML=Ζ1 +"<span class='Grey'>"+ Temp_1+"."+Temp_2+"</span>"+Ζ2;
			}	
			
			
		}
	}
}//for

Process_C=[];


console.log(Process_C);
$("#resultCont").html("&nbsp;D1: <span id='result2'>"+Result+"</span>");

	steps= String(Result).length-1;
	//Feed the new numbers (fixed) to an array for STEPS

	var x2 = document.getElementsByClassName("CMedium");

	//console.log("x.length= "+ x2.length);
	Process_C2.pop();
	
	for (var i = 0, len = x2.length; i < len; i += 1) {
	
	Process_C2.push(x2[i].innerText);
	}
	//console.log("Process_C2[0]= "+Process_C2[0]);
	//console.log(Process_C2);
	Process_C2=[];
	//console.log(Process_C2);

}//Align results func


var H=0;

//Used in case of  a very large decimal number that fails to be calculated accurately after 6 or 7 decimals behind comma
function bigCalc1(A,B){
	H=0;
	MediumX = new Big(MediumX);
		
		
	
		var J = "";
		while (H < M) {J = "0" + J; H+=1; }
		M+=1;
		J="1"+J;
		MediumX = MediumX.plus(A).times(B).times(Number(J));
		return MediumX;
}



function bigCalc2(A,B,DLB){
	H=0;
	MediumX = new Big(MediumX);
		
		
		
		var J = "";
		while (H < DLB) {J = "0" + J; H+=1; }
		J="1"+J;
		DLB-=1;
		MediumX = MediumX.plus(A).times(B).div(Number(J));
		return MediumX;
}

//Πολλαπλασιασμος
var wasAhead1=false;
var wasBack1=false;
var stepAhead1=1;
var ThisC=0;

//Multiply buttons
	let wasBackAdd;
	let wasAheadAdd;


//Move button for Move-ahead -M2 STEP 2 Addition
$("#StepAheadM2").click(function(){
	//restore other buttons variables
	wasAhead1=false;
	wasBack1=false;
	stepAhead1=1;
	ThisC=0;
	isMax=false;
	isDot=false;

	
document.getElementById("StepBackM1").disabled = true;



alignResults($("#result2").text());
	//alert("steps="+steps);
	//alert("wasBackAdd= "+wasBackAdd);
	//alert("stepAhead= "+stepAhead);
	//alert("wasAheadAdd= "+wasAheadAdd);


//------
	wasAheadAdd=true;
//-----
//alert("Step Ahead");
	var N_D2 =$("#result2").text();
	

	
	var TotalLen= N_D2.length;
	var x4 = $("#main_B2 em");

	//stepBack=0;
	// A
	if(N_D2.charAt(steps-stepAhead)=="."){
		stepAhead+=1;
	}
	if(wasBackAdd){
		stepAhead+=1;
		wasBackAdd=false;
	}
	var x5 = $(".CMedium span");
var x3 = document.getElementsByClassName("CMedium");
	for (var i = 0, len = x3.length; i < len; i += 1) {
		var col_C=x3[i].innerText.slice(0,steps-stepAhead)+"<span class='Red'>" +x3[i].innerText.charAt(steps-stepAhead)+"</span>"+x3[i].innerText.slice(steps-stepAhead+1);
		x3[i].innerHTML=col_C;
	}
	
	//Result  
	
	var col_D=N_D2.slice(0,steps-stepAhead)+"<span class='Red'>" +N_D2.charAt(steps-stepAhead)+"</span>"+N_D2.slice(steps-stepAhead+1);
	$("#result2").html(col_D);
	
//alert("x4.text().length-stepAhead1==== "+(x4.text().length-stepAhead1));
//alert("$('#main_A2 em')="+$("#main_A2 em").text());
//alert("x4.text().charAt(x4.text().length-stepAhead1)= "+x4.text().charAt(x4.text().length-stepAhead1));
//alert("stepAhead1= "+stepAhead1);
		$("#Instructions").html(
			"Πρόσθεσε όλους τους αριθμούς του C και το αποτέλεσμα θα είναι το D1:<span class='Red'> "+N_D2.charAt(steps-stepAhead)+"</span> <br><hr> όμως άν το αποτέλεσμα είναι μεγαλύτερο του 9 γράφουμε τις μονάδες και προσθέτουμε τις δεκάδες(κρατούμενο) στο απόμενο"
			);
	
	if(steps-stepAhead<=0){
		//alert("is 0");
		
	}else{
		
		
		stepAhead+=1;
	}

});
	
	
	

	
	
	
	
	
	
//Move button for Move-Back -M2 STEP 2 Addition
$("#StepBackM2").click(function(){
	//restore other buttons variables
		wasAhead1=false;
		wasBack1=false;
		stepAhead1=1;
		ThisC=0;
		isMax=false;
		isDot=false;
		document.getElementById("StepBackM1").disabled = true;
		

		
alignResults($("#result2").text());
	var Atarget=$("#main_A2 em").css("color","grey");
	var x4 = $("#main_B2 em");
	
	$("#main_B2 em").text(x4.text());
	
	//alert("x4.innerText= "+x4.text());
		x4 = x4.text();
		
		
/*	steps= $("#result2").text().length-1;
	wasBackAdd=false;
	stepAhead=0;
	wasAheadAdd=false*/
	//alert("steps="+steps);
	//alert("wasBackAdd= "+wasBackAdd);
	//alert("stepAhead= "+stepAhead);
	//alert("wasAheadAdd= "+wasAheadAdd);
	
	
	
	wasBackAdd=true;
//-----
//alert("Step Back");
	var N_D2 =$("#result2").text();
	

	
	var TotalLen= N_D2.length;
	

	//stepBack=0;
	// A
	if(N_D2.charAt(steps-stepAhead)=="."){
		stepAhead-=1;
	}
	if(wasAheadAdd){
		stepAhead-=1;
		wasAheadAdd=false;
	}
// C1 C2 C3...
	//var col_A=N_A2.slice(0,steps-stepAhead)+"<span class='Red'>" +N_A2.charAt(steps-stepAhead)+"</span>"+N_A2.slice(steps-stepAhead+1);

	//$("#main_A2").html(col_A);
	
	var x3 = document.getElementsByClassName("CMedium");
	console.log(x3);
	for (var i = 0, len = x3.length; i < len; i += 1) {
		var col_C=x3[i].innerText.slice(0,steps-stepAhead)+"<span class='Red'>" +x3[i].innerText.charAt(steps-stepAhead)+"</span>"+x3[i].innerText.slice(steps-stepAhead+1);
		x3[i].innerHTML = col_C;
	}
	//alert("stepAhead= "+stepAhead)
	
	
	//Result
	var col_D=N_D2.slice(0,steps-stepAhead)+"<span class='Red'>" +N_D2.charAt(steps-stepAhead)+"</span>"+N_D2.slice(steps-stepAhead+1);
	$("#result2").html(col_D);
	
//alert("x4.text().length-stepAhead1==== "+(x4.text().length-stepAhead1));
//alert("$('#main_A2 em')="+$("#main_A2 em").text());
//alert("x4.text().charAt(x4.text().length-stepAhead1)= "+x4.text().charAt(x4.text().length-stepAhead1));
//alert("stepAhead1= "+stepAhead1);
		$("#Instructions").html(
			"Πρόσθεσε όλους τους αριθμούς του C και το αποτέλεσμα θα είναι το D1:<span class='Red'> "+N_D2.charAt(steps-stepAhead)+"</span> <br><hr> όμως άν το αποτέλεσμα είναι μεγαλύτερο του 9 γράφουμε τις μονάδες και προσθέτουμε τις δεκάδες(κρατούμενο) στο απόμενο"
			);
	
	if(steps-stepAhead>=steps){
		//alert("is MaX");
		
	}else{
		
		
		stepAhead-=1;
	}
	
	

});












var isMax=false;
var isDot=false;
//Move button for Move-ahead -M1 STEP 1 Multiplication
$("#StepAheadM1").click(function(){
	

	//Restore other steps variables
	steps= $("#result2").text().length-1;
	wasBackAdd=false;
	stepAhead=0;
	wasAheadAdd=false
	

	//alert("Begin Back:  stepAhead1=" +stepAhead1 + " ThisC= "+(ThisC))


	//alert("New step:  stepAhead1=" +stepAhead1 + " ThisC= "+(ThisC))
	
	
	
	if(isMax){
		var x5 = $(".CMedium span");
	var x4 = $("#main_B2 em");

	
	var MaxC=x4.text().length-1;
		//alert("Termination ->>isMax");
		console.clear();
		console.log("stepAhead1= "+stepAhead1);
		console.log("ThisC= "+ThisC);
		console.log("x5.lebgth= "+x5.length);
		console.log("x5[0]= "+x5[0].innerText);
		console.log("x5[0]= "+x5[x5.length-1].innerText);
		console.log("MaxC="+MaxC);

			ThisC=x5.length-1;
		
		stepAhead1=MaxC;
		
	}else{
	alignResults($("#result2").text());
	
	var Atarget=$("#main_A2 em").css("color","red");
	var x4 = $("#main_B2 em");

	
	var MaxC=x4.text().length-1;
////////////////////////////----------------------	
	var x5 = $(".CMedium span");
	wasAhead1=true;


		
	
	
//-----
//alert("Step Ahead");
	

	//stepBack=0;
	// A
	//console.log(x4);
	//alert("x4.text()=="+x4.text())
	if(x4.text().charAt(x4.text().length-stepAhead1)=="."){
		stepAhead1+=1;
		isDot=true;
		//alert("is Dot");
	}
	if(wasBack1){
		stepAhead1+=2;
		ThisC+=1;
		wasBack1=false;
		//alert("ΠΑΟΚ 222= "+stepAhead1 + " AEK 2= "+ThisC);
	}
	
	
	
	
	//alert("ΠΑΟΚ 444= "+stepAhead1 + " AEK 444= "+(ThisC));
	//console.log("1)= "+x4.text().slice(0,x4.text().length-stepAhead1));
	//console.log("2)= "+"<span class='Red'>" +x4.text().charAt(x4.text().length-stepAhead1)+"</span>");
	//console.log("3)= "+x4.text().slice(x4.text().length-stepAhead1+1));
	
	console.log("4 111)= "+stepAhead1);
	console.log("5 111)= "+(ThisC+1));
		var col_C4=x4.text().slice(0,x4.text().length-stepAhead1)+"<span class='Red'>" +x4.text().charAt(x4.text().length-stepAhead1)+"</span>"+x4.text().slice(x4.text().length-stepAhead1+1);
		console.log("col_C4="+col_C4);
		
		
		x4.html(col_C4);
//alert("x4.text().length-stepAhead1==== "+(x4.text().length-stepAhead1));
//alert("$('#main_A2 em')="+$("#main_A2 em").text());
//alert("x4.text().charAt(x4.text().length-stepAhead1)= "+x4.text().charAt(x4.text().length-stepAhead1));
//alert("x5[ThisC]= "+x5[ThisC].innerText);
	if(Lang=="Eng"){
		
		$("#Instructions").html(
			"Multiply the number A: "+$("#main_A2 em").text()+" with the part from number B:<b class='Red'> " +x4.text().charAt(x4.text().length-stepAhead1)+" </b>write the result below like: <b class='Red'>"+x5[ThisC].innerText
			+"</b><br><hr>At this point becareful of the decimal placement, if the part of number B: <b class='Red'>"+x4.text().charAt(x4.text().length-stepAhead1)+"</b> is 'X' decimal places right of the comma then you must place the result exactly that many decimal placements to the right of the comma aswell and repeat"
			+"<br><hr>Example:Multiplication is Addition too"
			+"<br>Multiply the number <b class='Orang'>140</b> with the number <b class='Orang'>3</b>"
			+"<br>140   x1"
			+"<br>140   x2"
			+"<br>140   x3"
			+"<br>-----------"
			+"<br>420 Simple addition was performed here"
			);
		
	}
	if(Lang=="Gre"){
		$("#Instructions").html(
			"Πολλαπλασίασε τον αριθμό A: "+$("#main_A2 em").text()+" με το μέρος του αριθμού B:<b class='Red'> " +x4.text().charAt(x4.text().length-stepAhead1)+" </b>γράψε το αποτέλεσμα ακριβώς άπο κάτω: <b class='Red'>"+x5[ThisC].innerText
			+"</b><br><hr>Προσοχή στο δεκαδικό, αν ο αριθμός B: <b class='Red'>"+x4.text().charAt(x4.text().length-stepAhead1)+"</b> είναι 'X' δεκαδικές θέσεις δεξιά τότε βάλε και το αποτέλεσμα τόσες θέσεις δεξιά του κόμματος"
			+"<br><hr>Παράδειγμα:Ο πολλαπλασιασμός είναι πρόσθεση προσθέσεων"
			+"<br>Πολλαπλασίασε τον αριθμό<b class='Orang'>140</b> με τον αριθμό <b class='Orang'>3</b>"
			+"<br>140   x1"
			+"<br>140   x2"
			+"<br>140   x3"
			+"<br>-----------"
			+"<br>420 απλή πρόσθεση"
			);
	}
	if(x4.text().length-stepAhead1>0){
		
		/*isMax=true;
		alert("is Max");
		stepAhead1+=1;*/
		document.getElementById("StepBackM1").disabled = true;
	}else{

			
		document.getElementById("StepBackM1").disabled = false;
			
		isMax=true;
		//alert("is Max");
		stepAhead1-=1;
		
		if(removeDots){
			ThisC=x5.length-1;
			//alert("removeDots was TRUE");
		}else{
			ThisC=x5.length-1;
			//alert("removeDots was NOT true");
		}
		
		
	}		
		

			
		if(ThisC == MaxC){
			console.log("5B222 1111)= "+(ThisC));
			if(removeDots){
				console.log("removeDots true");
				ThisC+=1;
			}
		ThisC-=1;
		x5[ThisC].style.color="red";
		
		}else{
			console.log("5B222 2222)= "+(ThisC)+ " MaxC= "+ MaxC);
			x5[ThisC].style.color="red";
			
		}
		console.log("5B3333 3333)= "+(ThisC)+ " MaxC= "+ MaxC);
		if(ThisC-1<0){
			
			
		}else{
			//x5[ThisC-1].style.color="black";
		}

	






	console.log("111 ThisC= "+ ThisC);	
	console.log("111 stepAhead1= "+ stepAhead1);
		stepAhead1+=1;
		ThisC+=1;
		
		}
		

});


// Back
//Move button for Move-back -M1 STEP 1 Multiplication
$("#StepBackM1").click(function(){
	

	//Restore other steps variables
	steps= $("#result2").text().length-1;
	wasBackAdd=true;
	stepAhead=0;
	wasAheadAdd=false
	//alert("stepAhead1 111 = "+stepAhead1);
	

		//alert("stepAhead1 222 = "+stepAhead1);
	alignResults($("#result2").text());
	
	var Atarget=$("#main_A2 em").css("color","red");
	var x4 = $("#main_B2 em");
	var x5 = $(".CMedium span");
	
	var MaxC=x4.text().length-1;
	
		if(ThisC <= 0){
			
			console.log("5B222 1111= "+(ThisC));
			//Write C-X: number
				x5[ThisC].style.color="red";
			//Write B: number
				var col_C4=x4.text().slice(0,x4.text().length-stepAhead1-1)+"<span class='Red'>" +x4.text().charAt(x4.text().length-stepAhead1-1)+"</span>"+x4.text().slice(x4.text().length-stepAhead1);
				console.log("col_C4="+col_C4);
				x4.html(col_C4);
				if(ThisC+1>MaxC){
					
					
				}else{
					//x5[ThisC+1].style.color="black";
				}	
			//
			//ThisC+=1;
			//stepAhead1+=1;
//alert("x4.text().length-stepAhead1==== "+(x4.text().length-stepAhead1));
//alert("$('#main_A2 em')="+$("#main_A2 em").text());
//alert("x4.text().charAt(x4.text().length-stepAhead1)= "+x4.text().charAt(x4.text().length-stepAhead1));
//alert("x5[ThisC]= "+x5[ThisC].innerText);
	if(Lang=="Eng"){
		
		$("#Instructions").html(
			"Multiply the number A: "+$("#main_A2 em").text()+" with the part from number B:<b class='Red'> " +x4.text().charAt(x4.text().length-stepAhead1-1)+" </b>write the result below like: <b class='Red'>"+x5[ThisC].innerText
			+"</b><br><hr>At this point becareful of the decimal placement, if the part of number B: <b class='Red'>"+x4.text().charAt(x4.text().length-stepAhead1-1)+"</b> is 'X' decimal places right of the comma then you must place the result exactly that many decimal placements to the right of the comma aswell and repeat"
			+"<br><hr>Example:Multiplication is Addition too"
			+"<br>Multiply the number <b class='Orang'>140</b> with the number <b class='Orang'>3</b>"
			+"<br>140   x1"
			+"<br>140   x2"
			+"<br>140   x3"
			+"<br>-----------"
			+"<br>420 Simple addition was performed here"
			);
		
	}
	if(Lang=="Gre"){
		$("#Instructions").html(
			"Πολλαπλασίασε τον αριθμό A: "+$("#main_A2 em").text()+" με το μέρος του αριθμού B:<b class='Red'> " +x4.text().charAt(x4.text().length-stepAhead1-1)+" </b>γράψε το αποτέλεσμα ακριβώς άπο κάτω: <b class='Red'>"+x5[ThisC].innerText
			+"</b><br><hr>Προσοχή στο δεκαδικό, αν ο αριθμός B: <b class='Red'>"+x4.text().charAt(x4.text().length-stepAhead1-1)+"</b> είναι 'X' δεκαδικές θέσεις δεξιά τότε βάλε και το αποτέλεσμα τόσες θέσεις δεξιά του κόμματος"
			+"<br><hr>Παράδειγμα:Ο πολλαπλασιασμός είναι πρόσθεση προσθέσεων"
			+"<br>Πολλαπλασίασε τον αριθμό<b class='Orang'>140</b> με τον αριθμό <b class='Orang'>3</b>"
			+"<br>140   x1"
			+"<br>140   x2"
			+"<br>140   x3"
			+"<br>-----------"
			+"<br>420 απλή πρόσθεση"
			);
	}
		}else{
			console.log("5B222 2222= "+(ThisC)+ " MaxC= "+ MaxC);
			
	if(wasAhead1){
		wasAhead1=false;
		//alert("was ahead");
		stepAhead1-=1;
		ThisC-=1;
		
		
		//alert("Termination ->>isMax");
		console.clear();
		console.log("stepAhead1= "+stepAhead1);
		console.log("ThisC= "+ThisC);
		console.log("x5.lebgth= "+x5.length);
		console.log("x5[0]= "+x5[0].innerText);
		console.log("x5[0]= "+x5[x5.length-1].innerText);
		console.log("MaxC="+MaxC);
		
		//stepAhead1=MaxC;
		//ThisC=x5.length-1;
	}	
		
//alert("x4.text().length-stepAhead1==== "+(x4.text().length-stepAhead1));
//alert("$('#main_A2 em')="+$("#main_A2 em").text());
//alert("x4.text().charAt(x4.text().length-stepAhead1)= "+x4.text().charAt(x4.text().length-stepAhead1));
//alert("stepAhead1= "+stepAhead1);
	if(Lang=="Eng"){
		
		$("#Instructions").html(
			"Multiply the number A: "+$("#main_A2 em").text()+" with the part from number B:<b class='Red'> " +x4.text().charAt(x4.text().length-stepAhead1-1)+" </b>write the result below like: <b class='Red'>"+x5[ThisC].innerText
			+"</b><br><hr>At this point becareful of the decimal placement, if the part of number B: <b class='Red'>"+x4.text().charAt(x4.text().length-stepAhead1-1)+"</b> is 'X' decimal places right of the comma then you must place the result exactly that many decimal placements to the right of the comma aswell and repeat"
			+"<br><hr>Example:Multiplication is Addition too"
			+"<br>Multiply the number <b class='Orang'>140</b> with the number <b class='Orang'>3</b>"
			+"<br>140   x1"
			+"<br>140   x2"
			+"<br>140   x3"
			+"<br>-----------"
			+"<br>420 Simple addition was performed here"
			);
		
	}
	if(Lang=="Gre"){
		$("#Instructions").html(
			"Πολλαπλασίασε τον αριθμό A: "+$("#main_A2 em").text()+" με το μέρος του αριθμού B:<b class='Red'> " +x4.text().charAt(x4.text().length-stepAhead1-1)+" </b>γράψε το αποτέλεσμα ακριβώς άπο κάτω: <b class='Red'>"+x5[ThisC].innerText
			+"</b><br><hr>Προσοχή στο δεκαδικό, αν ο αριθμός B: <b class='Red'>"+x4.text().charAt(x4.text().length-stepAhead1-1)+"</b> είναι 'X' δεκαδικές θέσεις δεξιά τότε βάλε και το αποτέλεσμα τόσες θέσεις δεξιά του κόμματος"
			+"<br><hr>Παράδειγμα:Ο πολλαπλασιασμός είναι πρόσθεση προσθέσεων"
			+"<br>Πολλαπλασίασε τον αριθμό<b class='Orang'>140</b> με τον αριθμό <b class='Orang'>3</b>"
			+"<br>140   x1"
			+"<br>140   x2"
			+"<br>140   x3"
			+"<br>-----------"
			+"<br>420 απλή πρόσθεση"
			);
	}
	
	
	
////////////////////////////----------------------	
		if(isMax){
			isMax=false;
			//stepAhead1+=1;
			//ThisC-=1;
			if(!wasAhead1){ //wasAhead1==false
				//ThisC-=1;
				//stepAhead1+=1;
				
			}
		}	
	wasBack1=true;
//-----
//alert("Step Ahead");
	

	//stepBack=0;
	// A
	//console.log(x4);
	//alert("x4.text()=="+x4.text())
	if(x4.text().charAt(x4.text().length-stepAhead1-1)=="."){
		//alert("I back DOT");
		stepAhead1-=1;
	}

		//alert("stepAhead1 333 = "+stepAhead1);
	//alert("ΠΑΟΚ 5555= "+stepAhead1 + " AEK 5555= "+(ThisC));
	//console.log("1)= "+x4.text().slice(0,x4.text().length-stepAhead1));
	//console.log("2)= "+"<span class='Red'>" +x4.text().charAt(x4.text().length-stepAhead1)+"</span>");
	//console.log("3)= "+x4.text().slice(x4.text().length-stepAhead1+1));

		//stepAhead1-=1;

		

		
	//Write C-X: number
		x5[ThisC].style.color="red";
	//Write B: number
		var col_C4=x4.text().slice(0,x4.text().length-stepAhead1-1)+"<span class='Red'>" +x4.text().charAt(x4.text().length-stepAhead1-1)+"</span>"+x4.text().slice(x4.text().length-stepAhead1);
		console.log("col_C4="+col_C4);
		x4.html(col_C4);
		if(ThisC+1>MaxC){
			
			
		}else{
			//x5[ThisC+1].style.color="black";
		}

	
	//alert("Begin Back:  stepAhead1=" +stepAhead1 + " ThisC= "+(ThisC))
		stepAhead1-=1;
		//alert("stepAhead1 555= "+stepAhead1);
		ThisC-=1;
	//alert("New step:  stepAhead1=" +stepAhead1 + " ThisC= "+(ThisC))
	

		}	
	
});



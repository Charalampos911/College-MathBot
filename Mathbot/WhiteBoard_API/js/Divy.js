var ResultDiv="";
var BoxNow=0;
var wasClick=false;
var wasContext=false;
function padDivy(a1, a2, b1, b2,oper) {
	//Διαιρεση με το 1 επιστρεφει τον ιδιο αριθμο
	if(b1==1 || b2==1){
		//alert("b1=1 or b2=1");
		$("#DivRes").html("");
				$( "#mainDiv_A2" ).text(a1+a2+"");
				$( "#mainDiv_B2" ).text(b1+b2+"");
		$("#resultContDiv").html("D1: "+a1+a2);
	$("#Instructions").html(
		"Any number divided with the number one '1' results itself"
		);	
		
	
		return;
	}

	
$("#DivRes").html("");
$("#resultContDiv").html("D1: ");
ResultDiv="";
//Aναβαση-καταβαση
BoxNow=0;
wasClick=false;
wasContext=false;
				pre_NumA=133186547; // 1331.86547
				pre_NumB=140; //   102.40500
			//console.log("a1="+a1);
			//console.log("a2="+a2);
			//console.log("b1="+b1);
			//console.log("b2="+b2);
			pre_NumA=a1+a2;
			pre_NumB=b1+b2;
//Διαιρεση με τον ιδιο αριθμοεπιστρεφει το 1 
	if(pre_NumA==pre_NumB){
		//alert("pre_NumA==pre_NumB");
		$("#DivRes").html("");
				$( "#mainDiv_A2" ).text(a1+a2+"");
				$( "#mainDiv_B2" ).text(b1+b2+"");
		$("#resultContDiv").html("D1: 1");
			if(Lang=="Eng"){
				$("#Instructions").html(
					"Any number divided with itself results the number one '1'"
					);			
			}
			if(Lang=="Gre"){
				$("#Instructions").html(
					"Η διαίρεση με το εαυτό σου κάνει πάντα '1'"
					);			
			}
		return;
	}
			
			//alert("pre_NumA= "+pre_NumA);
			//alert("pre_NumB= "+pre_NumB);
				var AhadDot=false;
				var BhadDot=false;
				//Fix numbers for Divy
					let PointAlignC8;	
					PointAlignC8 = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
					if(PointAlignC8.test(pre_NumA)){
						var strPreC81= String(pre_NumA).substr(0,String(pre_NumA).indexOf('.')); 
						var strPreC82= String(pre_NumA).substr(String(pre_NumA).indexOf('.'),).split('.').join(""); 
						//alert("strPreC82== "+strPreC82);
						//alert("strPreC82.length-1== "+String(strPreC82).split('.').join("").length);
						var Alen8=String(strPreC82).length;
							AhadDot=true;
					}
				//Fix numbers for Divy
					let PointAlignC7;	
					PointAlignC7 = new RegExp(/\b(\w*\.\w*)\b/g, "ig");
					if(PointAlignC7.test(pre_NumB)){
						var strPreC71= String(pre_NumB).substr(0,String(pre_NumB).indexOf('.')); 
						var strPreC72= String(pre_NumB).substr(String(pre_NumB).indexOf('.'),).split('.').join(""); 
						//alert("strPreC72== "+strPreC72);
						//alert("strPreC72.length-1== "+String(strPreC72).split('.').join("").length);
						var Blen8=String(strPreC72).length;
							BhadDot=true;
					}
					
					
					//Fix --> Alen8
					if(AhadDot){
						//alert("AhadDot TRUE");	
							if(Alen8<Blen8){  
								var s8 = strPreC82+"";
								while (s8.length < Blen8) s8 = s8 + "0";
							}else{
								s8 = strPreC82;
							}
							strPreA81= strPreC81;
							strPreA82= s8;
						var newA = strPreA81+"."+strPreA82;
					}else{
						var newA = pre_NumA;
						
					}
					
					//Fix --> Blen8
					if(BhadDot){
							if(Alen8>Blen8){  
								var s7 = strPreC72+"";
								while (s7.length < Alen8) s7 = s7 + "0";
							}else{
								s7 = strPreC72;
							}
							strPreB71= strPreC71;
							strPreB72=s7;
						var newB = strPreB71+""+strPreB72;
					}else{
						var newB = pre_NumB;
						
					}
					
					
		/*console.log("strPreA81== "+ strPreA81);
		console.log("strPreA82== "+ strPreA82);
		console.log("strPreB71== "+ strPreB71);
		console.log("strPreB72== "+ strPreB72);*/

		
		

		
		
		/*console.log("pre_NumA= "+ pre_NumA);
		console.log("pre_NumB= "+ pre_NumB);
		console.log("newA== "+ newA);
		console.log("newB== "+ newB);*/
		
				$( "#mainDiv_A2" ).text(pre_NumA+"");
				$( "#mainDiv_B2" ).text(pre_NumB+"");
				
	//alert("newA== "+ newA);	
				
	var TempA = Number(newA);
	//alert(" 012 TempA= "+TempA);
	var TempB = Number(newB);
	var MidStep=TempA;	

var MidB=[];	
//Function To make and use same length A and B
//if(String(TempA).length>String(TempB).length+1){
	MidB=String(TempA).split('');
	//alert(" 013 MidB= "+MidB);
	//console.log("Yahooooooo? 11-> "+MidB); //1,3,3,1,8,6,5,4,7
	//console.log("Yahooooooo? 22-> "+String(TempB)+" AND  "+String(TempB).length); // 102 AND  3
	//console.log("Yahooooooo? 33-> "+MidB.slice(0,(String(TempB).length)).join('')); //133
	//Καινουργιο υπολοιπο

	//console.log("new MidB="+MidB);
	//Μεχρι 6 φορες, υπολογισμος διαιρεσης
	for (var j = 0, len = 6; j < len;) {
	
//While( TempA < TempB )
	if(Number(MidB.slice(0,(String(TempB).length)).join(''))<Number(TempB)){
		//alert("066 MidB= "+MidB);//3,.,0,6,7
		
		//alert("066 MidB= "+MidB.join('').split(".").join(''));
		
		
		//alert("077 MidB= "+Number(MidB.slice(0,(String(TempB).length+1)).join('')));
	console.log("Yahooooooo? 41-> "+MidB.slice(0,(String(TempB).length+1)).join('')+" AND  "+MidB.slice(0,(String(TempB).length+1)).join(',,'));
	
	
	//
	
	MidB=MidB.join('').split(".").join('');
	//alert("MidB.join= "+MidB);
	/*if(MidStep<TempB){ // 3.067 divy 4 Midstep must be 30 before calcStep 
		alert("String(TempB).length= "+Number(String(TempB).length+1));
		
		alert("MidB.length= "+MidB.length);
		
		MidB
			
		alert(" 014-1 MidStep= "+MidStep);
	}else{
		
		MidStep=Number(MidB.slice(0,(String(TempB).length+1)).join(''));	
		alert(" 014-2 MidStep= "+MidStep);
	}*/
	MidStep=Number(MidB.slice(0,Number(String(TempB).length)+1));
	//alert(" 014-1 MidStep= "+MidStep);
	//MidStep=Number(MidB.slice(0,Number(String(TempB).length)+2));
	//alert(" 014-2 MidStep= "+MidStep);
	//MidStep=Number(MidB.slice(0,Number(String(TempB).length)+3));
	//alert(" 014-3 MidStep= "+MidStep);
	//console.log("Yahooooooo? 42-> MidStep= "+MidStep);
		//alert(" 44 j= "+j);
		//alert(" 44 TempB= "+TempB);
		//alert(" 44 MidStep= "+MidStep);
		if(TempB < MidStep){
			j += 1;
		}
		//alert(" 45 j= "+j);
//alert(" 015 MidStep= "+MidStep);
		MidStep = CalcStep(MidStep,TempB,newB,j);
		if(MidStep=="error 551"){ //was zero 0
			//alert("error 551");
			j=len;
			MidStep=0;
		}
		
//alert(" 016 MidStep= "+MidStep);
		
	var p = MidStep +  MidB.slice((String(TempB).length+1),);
	
//While( TempA > TempB )
	}else if(Number(MidB.slice(0,(String(TempB).length)).join(''))>Number(TempB)){
		
		//alert("is Greater than TempB");
		//alert("Number(MidB.slice(0,(String(TempB).length)).join(''))=== "+Number(MidB.slice(0,(String(TempB).length)).join('')));
		//alert("Number(TempB)=== "+Number(TempB));

	console.log("Yahooooooo? 43 HRC-> TempB= "+TempB +" MidStep="+ MidStep);
	console.log("Yahooooooo? 43-> "+MidB.slice(0,(String(TempB).length)).join('')+" AND  "+MidB.slice(0,(String(TempB).length)).join(',,'));
	MidStep=Number(MidB.slice(0,(String(TempB).length)).join(''));
	//console.log("Yahooooooo? 44-> MidStep= "+MidStep);
	
		if(TempB < MidStep){
			j += 1;
		}
		MidStep = CalcStep(MidStep,TempB,newB,j);
		
		
		
		//Σε περιπτωση που οι 6 φορες ειναι παρα πολες, προωρος τερματισμος της for()
		if(MidStep=="error 551"){ //was zero 0
			//alert("error 551");
			j=len;
			MidStep=0;
		}
		var p = MidStep +  MidB.slice((String(TempB).length),).join('');
	}else{
		
		//alert("MidB===TempB");
		
	}


		// Calculate only 6 times

		

	//console.log("P= "+p);
	MidB= String(p).split('');
		
	//console.log("TempB V V= ") //---step 1
	//console.log("TempA V V= "+ TempA);
	//console.log("MidStep= "+ MidStep);

	} // for
	
	
	
	
/*}else{
	// For same length A and B (CORRECT!)
	//Ειναι ο διαιρετης μικροτερος απο τον διαιρετεο?

	// Calculate only 6 times
	for (var j = 0, len = 6; j < len;) {
		
		if(TempB < MidStep){
			j += 1;
		}
		MidStep = CalcStep(MidStep,TempB,newB,j);
	console.log("TempB V V= ") //---step 1
	console.log("TempA V V= "+ TempA);
	console.log("MidStep= "+ MidStep);

	}*/





	/*console.log("a1= "+a1);
	console.log("a2= "+a2);
	console.log("b1= "+b1);
	console.log("b2= "+b2);
	}*/
}
//TembB times uP || can it fit inside TempA?
//TempA== 133186547 //Διαιρετης --> MidStep
//TempB== 10240500  //Διαιρετεος
//MidStep= 60047

function CalcStep(MidStep,TempB,newB,j){ //newB is used to restore Διαιρετεος
	var uP=0;
	
	
	//alert("97 MidStep="+MidStep);
	if(Number(MidStep)==0){  //was zero
		
		//alert("44 was ZERO ");
		return "error 551";
	}
	
		//alert("44 MidStep="+MidStep);
		if(TempB < MidStep){
			
			//alert("TempB < MidStep");
		
		while (TempB < MidStep) {
			TempB = Number(newB);
			uP+=1;
			TempB = Number(TempB) * uP;
			// MidStep==18
			console.log("TempB 55 == "+ TempB);
		//console.log("uP 55 == "+ uP);		
		}
		var prevMidStep=MidStep;
		var MultiDiaireteos=0;
		if(MidStep==TempB){
			//alert("Malaka TempB= "+TempB);
			uP+=1;
			
		}
		if(uP>0){
			MultiDiaireteos=(Number(newB) * (uP-1));
			MidStep= MidStep-MultiDiaireteos;
			//700-700=000
			//---
			ResultDiv=ResultDiv+"<span id="+j+">"+(uP-1);
			//Αν παρει πανω απο 1 επομενο νουμερο, βαλε ενα μηδενικο στο τελικο αποτελεσμα
			//alert("Error 303 MidStep="+MidStep);
			var h3=String(MidStep).length;
			
			if((String(newB).length-h3)>1){
				//alert("Error 304 h3="+h3);
				//alert("String(newB).length-1="+(String(newB).length));
				//alert("newB="+newB);
				while (h3< (String(newB).length) ){
					h3+=1;
					ResultDiv=ResultDiv+"0";
					console.log("newB 66 == "+ newB);
					//alert("Error 305");
				}
			}
			ResultDiv= ResultDiv+"</span>";
			//---
			
			
			
			
		}else{
			
			MidStep= MidStep-(Number(newB) * (0));
			
		}

		
		
		
		console.log("Exodos");
		$("#resultContDiv").html("D1: "+ ResultDiv);
		$("#DivRes").append("<div class='box' id='"+j+"'> A: <span>"+prevMidStep+" </span><br>   B: <span>"+MultiDiaireteos+" </span><br>      C: <span>"+MidStep+" </span><br></div>");

		
		
		return MidStep;
		}
		
		//When Διαιρετης Μικροτεροες και Διαιρετεος μεγαλητερος
		if(Number(MidStep) < TempB){
		//alert("WARNING: Error 508-1 Number(MidStep)= "+Number(MidStep));
		//alert("WARNING: Error 508-2 Number(MidStep) < TempB= "+TempB);
		//alert("WARNING: Error 508-3 j= "+j);
		if(j==0){ //When 3 divy 4 it becomes 30 divy 4 needs 0.result [0.75]
			ResultDiv=ResultDiv+"0.";
			
		}		
		
		//console.log("PRE MidStep 11====>>>>> " +MidStep);
		
		
		while (Number(MidStep) < TempB) {
			TempB = Number(newB);
			MidStep = MidStep +"0";
			//alert("WARNING: Error 502 uP="+uP);
			//alert("j== "+j);
			uP+=1;
			console.log(uP+" : ==>"+ MidStep);
			//console.log("TempB 55 == "+ TempB);
		//console.log("uP 66 == "+ uP);		
		}	
		//alert("WARNING: Error 509");
		while (uP > 1) {
			ResultDiv=ResultDiv+"0";
			uP-=1;
			console.log(uP+" 11 : ==>"+ MidStep);
			//alert("WARNING: Error 503");
		}
		console.log("Exodos 222");
		return MidStep;
	}	
	
	
}
//Ckick events
var BoxNow=0;
var wasClick=false;
var wasContext=false;
// left click
$( "#DivRes" ).click(function() {   
  //alert( "Handler for .click() called." );
  //Handle αναβαση-καταβαση
  wasClick=true;
 if(wasContext){
	 BoxNow+=1;
	 wasContext=false;
 } 
  if($( ".box" ).length==BoxNow){
	  //alert( "Maxxxed ");
	  
	  
  }else{
	$( ".box" ).removeClass( "boxNow" );
	$( ".box" ).eq( BoxNow ).addClass( "boxNow" );
	
	//Handle highlight of the result parts
	$( "#resultContDiv span" ).removeClass( "boxNow" );
	$( "#resultContDiv span" ).eq( BoxNow ).addClass( "boxNow" ); 
	
	if(Lang=="Eng"){
		$("#Instructions").html(
		"Take from number A: "+ pre_NumA +" the portion from the front that number B:<b>"+pre_NumB+ "</b> can fit in like: <b class='Red'>"+$( ".box" ).eq( BoxNow ).find("span").eq(0).text()
		+"</b><hr><br>Then you must calculate how many times number B can fit inside that portion of number A like: <b class='Red'>"+ $( ".box" ).eq( BoxNow ).find("span").eq(1).text()
		+"</b><hr><br> That would be added to the number D1: <b class='Red'>"+$( "#resultContDiv span" ).eq( BoxNow ).text()
		+"</b><hr><br> Then, you must add to the left-over number <b class='Red'>"+$( ".box" ).eq( BoxNow ).find("span").eq(2).text()+"</b> that many digits from number A until the number B can fit in again and repeat"
		);
	}
	if(Lang=="Gre"){
		$("#Instructions").html(
		"Πάρε από τον αριθμό A: "+ pre_NumA +" το μέρος απο μπροστά όπου ο αριθμός B:<b>"+pre_NumB+ "</b> χωράει έστω μία φορά: <b class='Red'>"+$( ".box" ).eq( BoxNow ).find("span").eq(0).text()
		+"</b><hr><br>Υπολόγισε πόσες φορές χωράει: <b class='Red'>"+ $( ".box" ).eq( BoxNow ).find("span").eq(1).text()
		+"</b><hr><br> Γράψε το αποτέλεσμα στον D1: <b class='Red'>"+$( "#resultContDiv span" ).eq( BoxNow ).text()
		+"</b><hr><br> μετά κατεβάζουμε στον τον αριθμό <b class='Red'>"+$( ".box" ).eq( BoxNow ).find("span").eq(2).text()+"</b> τόσα ψηφία από τον αριθμό Α μέχρι ο αριθμός Β να χωράει ξανα"
		);
	}
	BoxNow+=1;
	
	
  }

 
  
});

// Right click
$( "#DivRes" ).contextmenu(function(event) {
	event.preventDefault();
	//Handle αναβαση-καταβαση
	wasContext=true;
	if(wasClick){
	 BoxNow-=1;
	 wasClick=false;
	} 
  //alert( "Handler for .contextmenu() called." );
  if(BoxNow==0){
	  //alert( "Min _N_ ned ");
	  
	  
  }else{
	  BoxNow-=1;
	$( ".box" ).removeClass( "boxNow" );
	$( ".box" ).eq( BoxNow ).addClass( "boxNow" );
	//Handle highlight of the result parts
	$( "#resultContDiv span" ).removeClass( "boxNow" );
	$( "#resultContDiv span" ).eq( BoxNow ).addClass( "boxNow" ); 
	
	
	if(Lang=="Eng"){
		$("#Instructions").html(
		"Take from number A: "+ pre_NumA +" the portion from the front that number B:<b>"+pre_NumB+ "</b> can fit in like: <b class='Red'>"+$( ".box" ).eq( BoxNow ).find("span").eq(0).text()
		+"</b><hr><br>Then you must calculate how many times number B can fit inside that portion of number A like: <b class='Red'>"+ $( ".box" ).eq( BoxNow ).find("span").eq(1).text()
		+"</b><hr><br> That would be added to the number D1: <b class='Red'>"+$( "#resultContDiv span" ).eq( BoxNow ).text()
		+"</b><hr><br> Then, you must add to the left-over number <b class='Red'>"+$( ".box" ).eq( BoxNow ).find("span").eq(2).text()+"</b> that many digits from number A until the number B can fit in again and repeat"
		);
	}
	if(Lang=="Gre"){
		$("#Instructions").html(
		"Πάρε από τον αριθμό A: "+ pre_NumA +" το μέρος απο μπροστά όπου ο αριθμός B:<b>"+pre_NumB+ "</b> χωράει έστω μία φορά: <b class='Red'>"+$( ".box" ).eq( BoxNow ).find("span").eq(0).text()
		+"</b><hr><br>Υπολόγισε πόσες φορές χωράει: <b class='Red'>"+ $( ".box" ).eq( BoxNow ).find("span").eq(1).text()
		+"</b><hr><br> Γράψε το αποτέλεσμα στον D1: <b class='Red'>"+$( "#resultContDiv span" ).eq( BoxNow ).text()
		+"</b><hr><br> μετά κατεβάζουμε στον τον αριθμό <b class='Red'>"+$( ".box" ).eq( BoxNow ).find("span").eq(2).text()+"</b> τόσα ψηφία από τον αριθμό Α μέχρι ο αριθμός Β να χωράει ξανα"
		);
	}
	
	
  }
  //Handle highlight of the result parts
  
  
  
});
<!DOCTYPE html>
<html>
<head>
<style>

</style>
<meta charset="utf-8" />
</head>
<!-- The user buttons interface markup code -->
<body>
<input id="B1" type="button" class="button" value="Easy" style="background-color: #009933;">
<input id="B2" type="button" class="button" value="Hard" style="background-color: #ff6666; display:none; visibility: hidden;" >

<input id="B3" type="button" class="button B0" value="Plus (&#43;)"  style="background-color: #6fb3ca;" >
<input id="B4" type="button" class="button B0" value="Minus (&#8722;)" style="background-color: #6fb3ca;" >
<input id="B5" type="button" class="button B0" value="Multi (&#215;)" style="background-color: #6fb3ca;" >
<input id="B6" type="button" class="button B0" value="Divy (&#247;)"  style="background-color: #6fb3ca;" >

<!--<input id="B7" type="button" class="button B0" value="pow z&#8319;"  style="background-color: #6fb3ca;" >-->
<!--<input id="B8" type="button" class="button B0" value="root (&#8730;)" style="background-color: #6fb3ca;" >-->
<input id="B9" type="button" class="button B0 any" value="any" style="background-color: rgb(47, 110, 132); width: 200px;" >
<input id="BEng" type="button" class="button" value=" " style="width: 60px;" >
<input id="BGre" type="button" class="button" value=" " style="width: 60px;" >
<br>
<input id="B10" type="button" class="button B01 B3" value="1 " style="background-color: #8194e8;" >
<input id="B11" type="button" class="button B01 B3" value="2 " style="background-color: #8194e8;" >
<input id="B12" type="button" class="button B01 B3" value="3 " style="background-color: #8194e8;" >
<input id="B13" type="button" class="button B01 B3" value="4 " style="background-color: #8194e8;" >
<input id="B14" type="button" class="button B01 B3" value="5 " style="background-color: #8194e8;" >
<input id="B15" type="button" class="button B01 B3" value="6 " style="background-color: #8194e8;" >
<input id="B16" type="button" class="button B01 B3" value="7 " style="background-color: #8194e8;" >
<input id="B17" type="button" class="button B01 B3" value="8 " style="background-color: #8194e8;" >
<input id="B18" type="button" class="button B01 B3" value="9 " style="background-color: #8194e8;" >
<input id="B19" type="button" class="button B01 B3 all2" value="All " style="background-color: rgb(212, 107, 251);" >

</body>
<script charset="utf-8">
 $(function() {
		$( ".Kratu" ).prop( "title", "Carry" );
		$( ".Total" ).prop( "title", "Summary" );
		$( ".Rdown" ).prop( "title", "The number C" );
	$( "#GreRates" ).hide();
$( "#BGre" ).css('background-image', 'url(/chatbot/ico/greeceDark.png)');
	 $( "#BEng" ).on('click', function(e){
		$( "#BEng" ).css('background-image', 'url(/chatbot/ico/eng.png)');
		$( "#BGre" ).css('background-image', 'url(/chatbot/ico/greeceDark.png)');
		FlagsUsed=1;
		$( "#userInput" ).attr('title','press Enter to send...');
		
		$( "#B1" ).val('Easy');
		$( "#B2" ).val('Hard');
		$( "#B3" ).val('Plus ('+String.fromCodePoint(43)+")");
		$( "#B4" ).val('Minus ('+String.fromCodePoint(8722)+")"); 
		$( "#B5" ).val('Multi ('+String.fromCodePoint(215)+")");
		$( "#B6" ).val('Divy ('+String.fromCodePoint(247)+")");
		$( "#B9" ).val('any');
		$( "#B19" ).val('All ');
		$( "#B19" ).css('padding-left','25px');
		$( "#NSbtn" ).val('Restart');
		$( "#LogOut" ).val('Log-Out');
		
		
		
		$( ".Kratu" ).prop( "title", "Carry" );
		$( ".Total" ).prop( "title", "Summary" );
		$( ".Rdown" ).prop( "title", "The number C" );
		
		
		
		$( "#voiceInput" ).prop( "disabled", false );
		$( "#Synth" ).prop( "disabled", false );
					LoadMisstakes(CurrentUser.Pin);
					LoadScores(CurrentUser.Pin);
		$( "#MultyLable1" ).text('Step One: multiplication');
		$( "#MultyLable2" ).text('Step Two: Addition');
		$('#nick').attr('placeholder','Nickname');
		$( "#EngRates" ).show();
		$( "#GreRates" ).hide();
	 $( "#Cancel" ).val('Cancel');
	 $( "#Okey" ).val('Okey');
	 $( "#LogIn" ).val('Log-in');
	 $( "#Reg" ).val('Register');
	 
	 Lang="Eng";
	botReady();

	 WhiteBoardReset();
	 });		 
	 $( "#BGre" ).on('click', function(e){
		 $( "#BGre" ).css('background-image', 'url(/chatbot/ico/greece.png)');
		$( "#BEng" ).css('background-image', 'url(/chatbot/ico/engDark.png)');
		$( "#B1" ).val('Εύκολο');
		$( "#userInput" ).attr('title','Πάτησε Enter για να στείλεις...');
		FlagsUsed=1;
		$( "#B2" ).val('Δύσκολο');
		$( "#B3" ).val('Σύν ('+String.fromCodePoint(43)+")");
		$( "#B4" ).val('Πλήν ('+String.fromCodePoint(8722)+")"); 
		$( "#B5" ).val('Επί ('+String.fromCodePoint(215)+")");
		$( "#B6" ).val('Διά ('+String.fromCodePoint(247)+")");
		$( "#B9" ).val('τυχαία');
		$( "#B19" ).val('όλα');
		$( "#B19" ).css('padding-left','0px');
		
		$( ".Kratu" ).prop( "title", "Κρατούμενο" );
		$( ".Total" ).prop( "title", "Σύνολο" );
		$( ".Rdown" ).prop( "title", "Ο αριθμός C" );
		
					LoadMisstakes(CurrentUser.Pin);
					LoadScores(CurrentUser.Pin);
		$( "#MultyLable1" ).text('Βήμα πρώτο: Πολλαπλασιασμός');
		$( "#MultyLable2" ).text('Βήμα δεύτερο: Πρόσθεση');
		
		$('#nick').attr('placeholder','Όνομα');
		
		
		
		$( "#GreRates" ).show();
		
		$( "#EngRates" ).hide();
		
		
		
		$( "#NSbtn" ).val('Αρχή');
		$( "#LogOut" ).val('Έξοδος');
		
		$( "#voiceInput" ).prop( "disabled", true );
		$( "#Synth" ).prop( "disabled", true );
		//from voice.js
		$("#voiceInput").removeClass( "VoiceActive" );
		$Rec=false;
		
		$("#Synth").removeClass( "SynthActive" );
		$control= false;
		
		$Rec=false;
   
   
   
		 $( "#Cancel" ).val('άκυρο');
		 $( "#Okey" ).val('έτοιμος');
		 $( "#LogIn" ).val('Είσοδος');
		 $( "#Reg" ).val('Εγγραφή');
		 //alert('Lang= ' +Lang);
		 Lang="Gre";
		 //alert('Lang= ' +Lang);
		  botReady();
 

		  WhiteBoardReset();
		 });
	 
	 
	 function WhiteBoardReset(){
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

		 
	 }
	 
	 
//Stars with diffy on easy
sessionStorage.setItem("Dify", "easy"); //Dificulty
console.log(sessionStorage.getItem("Dify"));

sessionStorage.setItem("Opera", "any"); //Operator
console.log("Opera="+sessionStorage.getItem("Opera"));

sessionStorage.setItem("Number", "All"); //Number
console.log("Number="+sessionStorage.getItem("Number"));

 $( ".all" ).css("background-color","rgb(212, 107, 251)");

//Dificulty
 $( "#B2" ).hide();
	 $( "#B1" ).on('click', function(e){ //BtnEasy
		$( "#B1" ).hide();
		$( "#B1" ).css("visibility","hidden");
		$( "#B2" ).show();
		$( "#B2" ).css("visibility","visible");
		sessionStorage.setItem("Dify", "hard"); //Dificulty
		console.log(sessionStorage.getItem("Dify"));
	 });
	 $( "#B2" ).on('click', function(e){//BtnHard
		$( "#B2" ).hide();
		$( "#B2" ).css("visibility","hidden");
		$( "#B1" ).show();
		$( "#B1" ).css("visibility","visible");
		sessionStorage.setItem("Dify", "easy"); //Dificulty
		console.log(sessionStorage.getItem("Dify"));
	 });
//Dificulty

//Operators
	$( ".B0" ).on('click', function(e){
	 $( ".B0" ).css("background-color"," #6fb3ca");
	 
	 $( ".B0" ).css("color","white");
	 
	 $(this).css("background-color","rgb(47, 110, 132)");//.css("color","#cca9a9");
	 
	 $value=$(this).val();
	 //alert("$value11= "+$value);
	 
	 $value2=$value.substr(0,$value.indexOf(' '));
	 //alert("$value22= "+$value2);
	 if($value2==""){
		 
		//alert("$value33= null57 "+$value); 
		$value2=$value;
	 }
	 
	 
		sessionStorage.setItem("Opera", $value2); //Operator
		console.log("Opera="+sessionStorage.getItem("Opera"));
	
	});
//Operators
	
//Numbers
	$( ".B01" ).on('click', function(e){
	 $( ".B3" ).css("background-color"," #8194e8");
	 $(this).css("background-color","rgb(212, 107, 251)");
	 
	 $value=$(this).val();
	 $value=$value.substr(0,$value.indexOf(' '));
		sessionStorage.setItem("Number", $value); //Operator
		console.log("Number="+sessionStorage.getItem("Number"));
	
	});
//Numbers
	
 });
 
</script>

</html>
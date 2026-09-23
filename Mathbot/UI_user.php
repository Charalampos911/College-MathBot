<!DOCTYPE html>
<html>
<head>
<style>
#LogCont{
	position:relative;
	
	width:auto;	
	height:100%;
	display:inline-block;
	float:right;
}
#ScoreCont{
	position:relative;
	
	width:auto;	
	background-color:pink;
	height:100%;
	display:inline-block;
	float:left;
}
.text2{
	border: 0px solid black;
	background-color:#2f46cd;
	color:white;
	font-size: 1.5vw;
	margin:.3vw;
	
}
/*--1--*/
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: white;
  opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color: white;
}

::-ms-input-placeholder { /* Microsoft Edge */
  color: white;
}


</style>
</head>
<!-- User misstakes/scores and log-in/register container and code-->
<body>
<div id="UserMisstakesCont">	

</div>	
<div id="UserScoresCont">	

</div>	
<form id="LogCont">				
	<input type="button" value="Log-in" onclick="" id="LogIn" class="button"  style="background-color: #275666; ">
	<input type="button" value="Register" onclick="" id="Reg" class="button"  style="background-color: #5c57e4;">

		<input type="button" value="Cancel" onclick="" id="Cancel" class="button"  style="background-color: #a60c54;">
		<input type="button" value="Okey" onclick=""   id="Okey" class="button"  style="background-color: #497711;">
		<input type="button" value="Restart" onclick=""   id="NSbtn" class="button"  style="background-color: #497711;">
		<input type="button" value="Log-Out" onclick="" id="LogOut" class="button"  style="background-color: #a60c54;">
<br>
			<input class="text2" type="text" placeholder="Nickname" id="nick" title="Nickname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nickname'" /><br>
			<input class="text2" type="text" placeholder="Pin" id="pin" onKeyPress="SpecialKeyPin(event); if(this.value.length==15) return false;" title="Pin" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Pin'" />
			<input id="HiddenPin" type="hidden" value="">
			<br><h4 style="margin:0px; display:inline;">User:&nbsp;</h4><label id="lbl_UserLogged"></label>
</form>			
</body>
<script>
function SpecialKeyPin(e){
	//alert("e="+e.keyCode)
	console.log( "Handler for .keypress() called." );
    if (e.keyCode == 48 || e.keyCode == 49 || e.keyCode == 50  || e.keyCode == 51 || e.keyCode == 52 || e.keyCode == 53 || e.keyCode == 54 || e.keyCode == 55 || e.keyCode == 56 || e.keyCode == 57) { 
        
		console.log( "Wasa Pin number" );
    }else{
		event.preventDefault();
	}
} 



 $(function() {

	 
	 
//Stars with diffy on easy
 sessionStorage.setItem("Dify", "easy"); //Dificulty
 console.log(sessionStorage.getItem("Dify"));

 sessionStorage.setItem("Number", "All"); //Operator
 console.log("Number="+sessionStorage.getItem("Number"));
//Initial state
 $( ".all" ).css("background-color","rgb(212, 107, 251)");
 
 if(Lang=="Eng"){
	$( "#lbl_UserLogged" ).text("Guest");	
 }
 if(Lang=="Gre"){
	$( "#lbl_UserLogged" ).text("Επισκέπτης");	
 }
 $( "#Cancel" ).hide();
  $( "#NSbtn" ).hide();

 $( "#Okey" ).hide();
 $( "#Cancel" ).css("visibility","hidden");
 $( "#Okey" ).css("visibility","hidden");
 $( "#pin" ).hide();
 $( "#pin" ).css("visibility","hidden");
 $( "#nick" ).hide();
 $( "#nick" ).css("visibility","hidden");
 $( "#LogOut" ).hide();
 $( "#LogOut" ).css("visibility","hidden");	
//How to Log-In
 $Z1="";
$( "#RateMe" ).hide();
	 $( "#LogIn" ).on('click', function(e){


		 $Z1="log";//this indicated ->Log-In
		 //Set, state
		 //Hide
		 $( "#nick" ).val(""); 
		 $( "#pin" ).val("");
		 $( "#LogIn" ).hide();
		 $( "#Reg" ).hide();
		 $( "#LogIn" ).css("visibility","hidden");
		 $( "#Reg" ).css("visibility","hidden");
		//Show
		 $( "#Cancel" ).show();
		 $( "#Okey" ).show();
		 $( "#Cancel" ).css("visibility","visible");
		 $( "#Okey" ).css("visibility","visible");
		 $( "#pin" ).show();
		 $( "#pin" ).css("visibility","visible");
		
	 });
	 
	 $( "#Reg" ).on('click', function(e){
		 $Z1="reg";//this indicated ->Register
		//Set, state
		
		 //Hide
		 
		  $( "#nick" ).val("");
		  $( "#pin" ).val("");
		  $( "#LogIn" ).hide();
		  $( "#Reg" ).hide();
		  $( "#LogIn" ).css("visibility","hidden");
		  $( "#Reg" ).css("visibility","hidden");
		 //Show

		  $( "#Cancel" ).show();
		  $( "#Okey" ).show();
		  $( "#Cancel" ).css("visibility","visible");
		  $( "#Okey" ).css("visibility","visible");pin
		  $( "#nick" ).show();
		  $( "#nick" ).css("visibility","visible");
		  $( "#pin" ).show();
		  $( "#pin" ).css("visibility","visible");
		
	 });
	 $( "#Cancel" ).on('click', function(e){
		//Return to state
		 //Show
		  $( "#NSbtn" ).hide();
		  $( "#LogIn" ).show();
		  $( "#Reg" ).show();
		  $( "#LogIn" ).css("visibility","visible");
		  $( "#Reg" ).css("visibility","visible");
		 //Hide
		  $( "#Cancel" ).hide();
		  $( "#Okey" ).hide();
		  $( "#Cancel" ).css("visibility","hidden");
		  $( "#Okey" ).css("visibility","hidden");pin
		  $( "#pin" ).hide();
		  $( "#pin" ).css("visibility","hidden");
		  $( "#nick" ).hide();
		  $( "#nick" ).css("visibility","hidden");
		  
	 });
	 
//Objects
window.sugg=new String();
window.CurrentUser=new String();
CurrentUser.Nick="";
//Submit
$( "#Okey" ).on('click', function(e){
	console.log("Z1= "+$Z1);
	if($Z1=="reg"){
		if($( "#nick" ).val()!=""){
			sugg.t1=$( "#nick" ).val();
		}else{
		sugg.t1="";
		
			if(Lang=="Eng"){
				alert("Give me your Nickname");
			}
			if(Lang=="Gre"){
				alert("Γράψε το όνομα σου");
				
			}
		return;
		}
	}
		if($( "#pin" ).val()!=""){
			sugg.t2=$( "#pin" ).val();
		}else{
		sugg.t2="";
		if(Lang=="Eng"){
			alert("Give me your PIN");
		}
		if(Lang=="Gre"){
			alert("Γράψε το PIN");
		}
		
		
		
		return;
		}	
		console.log("sugg.t1= "+sugg.t1);
		console.log("sugg.t2= "+sugg.t2);
	if($Z1=="reg"){
		Register();
	}else{
		LogIn();
	}
	
});

//The user register code, using ajax to call the -php register- code
	function Register() {
	  $.ajax({                                      
			url: 'PostUserRegistration.php',          
			data: {nick: sugg.t1, pin: sugg.t2},			   
			dataType: 'json',  	//data format 
			beforeSend : function()    {           
					//--007			
			},
			success: function(data)   
			{	
			//alert("registration was successful);
				if(data){
					if(Lang=="Eng"){
						alert("registration was successful");
					}
					if(Lang=="Gre"){
						alert("Επιτυχία εγγραφής");
					}
					CurrentUser.Nick=sugg.t1;
					console.log(CurrentUser.Nick);
					CurrentUser.Pin=sugg.t2;
					console.log(CurrentUser.Pin);
					
					//alert("CurrentUser.Pin="+CurrentUser.Pin);
					LoadMisstakes(CurrentUser.Pin);
					LoadScores(CurrentUser.Pin);
					$( "#HiddenPin" ).val(""+CurrentUser.Pin);

				 //Hide
					$( "#LogIn" ).hide();
					$( "#Reg" ).hide();
					$( "#LogIn" ).css("visibility","hidden");
					$( "#Reg" ).css("visibility","hidden");
					$( "#Cancel" ).hide();
					$( "#Okey" ).hide();
					$( "#Cancel" ).css("visibility","hidden");
					$( "#Okey" ).css("visibility","hidden");
					$( "#pin" ).hide();
					$( "#pin" ).css("visibility","hidden");
					$( "#nick" ).hide();
					$( "#nick" ).css("visibility","hidden");
				 //User Nickname label
					$( "#lbl_UserLogged" ).html(""+CurrentUser.Nick);
				 //Show
					$( "#LogOut" ).show();
					$( "#LogOut" ).css("visibility","visible");	
					$( "#NSbtn" ).show();
				}else{
					if(Lang=="Eng"){
						alert("PIN: "+sugg.t2+" is taken, select a different one");
					}
					if(Lang=="Gre"){
						alert("Το PIN: "+sugg.t2+" είναι δεσμευμένο, διάλεξε ένα διαφορετικό");
					}
				}
				
			}// end of success
			
			});//end of ajax


	}
window.Rated=0;
//The user Log-in code, using ajax to call the -php LogIn- code
window.LogIn=function(){
	
	
	
	console.log("sugg.t2==="+sugg.t2);
	  $.ajax({                                      
			url: 'UserLogIn.php',      
			data: "pin="+sugg.t2,			   
			dataType: 'json',          
			beforeSend : function()    {           
					//--007			
			},
			success: function(data)   
			{
				if(data.length!=0){
					
					
					Rated = data[0]['Rated'];
					console.log(data);
				 //Update Session Object 
					CurrentUser.Nick=data[0]['Nick'];
					console.log("Sync.Nick="+CurrentUser.Nick);
					CurrentUser.Pin=data[0]['Pin'];
					
					console.log("Sync.Pin="+CurrentUser.Pin);
				 //User Nickname label
					$( "#lbl_UserLogged" ).html(""+CurrentUser.Nick); 
					$( "#HiddenPin" ).val(""+CurrentUser.Pin);
				 //Hide
					$( "#LogIn" ).hide();
					$( "#Reg" ).hide();
					$( "#LogIn" ).css("visibility","hidden");
					$( "#Reg" ).css("visibility","hidden");
					$( "#Cancel" ).hide();
					$( "#Okey" ).hide();
					$( "#Cancel" ).css("visibility","hidden");
					$( "#Okey" ).css("visibility","hidden");
					$( "#pin" ).hide();
					$( "#pin" ).css("visibility","hidden");
					$( "#nick" ).hide();
					$( "#nick" ).css("visibility","hidden");
				 //Show
					$( "#LogOut" ).show();
					$( "#NSbtn" ).show();
					$( "#LogOut" ).css("visibility","visible");	
					//alert("CurrentUser.Pin="+CurrentUser.Pin);
					
			//gET aCTIVITY TO DECIDE IF ALIGIBLE TO RATE		
		$.ajax({                                      
			url: 'GetUserActivity.php',          
			data: {UserPin: CurrentUser.Pin,},			   
			dataType: 'json',  	//data format 
			beforeSend : function()    {           
					//--007	
				//alert("Ready: Sending rates to database");					
			},
			success: function(data)   
			{
				//alert(" data[ScorePlus]= "+ data[0]['Activity'] )
				CurrentUser.Activity=data[0]['Activity'];
				console.log("CurrentUser.Activity=="+CurrentUser.Activity);
			
				
				//alert("Rated= "+Rated);
				if(CurrentUser.Activity>10&& Rated!=1)  {
					//alert("CurrentUser.Activity= "+CurrentUser.Activity)
					$( "#RateMe" ).show();//.hide();
					
				}else{
					//alert("CurrentUser.Activity= "+CurrentUser.Activity)
					
					
				}
				
			
				
				
			
			}// end of success
			
			});//end of ajax	
					
					
					
					
					
					
					LoadMisstakes(CurrentUser.Pin);
					LoadScores(CurrentUser.Pin);
				}else{
					if(Lang=="Eng"){
						alert("Wrong PIN, try again");
					}
					if(Lang=="Gre"){
						alert("Λάθος PIN, δοκίμασε πάλι");
					}
				}

			}// end of success
			
		});//end of ajax
	}
	
	
$( "#LogOut" ).on('click', function(e){
	
	
	$( "#RateMe" ).hide();
	$( "#NSbtn" ).hide()
	Rated=0;
	 //Show
		$( "#LogIn" ).show();
		$( "#Reg" ).show();
		$( "#LogIn" ).css("visibility","visible");
		$( "#Reg" ).css("visibility","visible");
	 //Hide
		$( "#LogOut" ).hide();
		$( "#LogOut" ).css("visibility","hidden");	
	 //User Nickname label
		$( "#lbl_UserLogged" ).text("Guest");
	 //Update Session Object 
		CurrentUser.Nick="Guest";
		CurrentUser.Pin="";	
		$( "#HiddenPin" ).val("");
		$( "#UserMisstakesCont" ).html("");
		$( "#UserScoresCont" ).html("");
		
});
$( "#NSbtn" ).on('click', function(e){
	
RestartLesson();
	
	
});
//
//-------------------------
//
$(document).on('click', '.MisTBox', function(e){ 

		if(e.target.parentElement.id=="UserMisstakesCont"){
			//When user clicks inside the MisTBox clicks the MisTBox itself, get the data stored in the children
			//alert("was UserMisstakesCont = "+e.target.id);
			//alert("child_1="+e.target.children[0].id);
			//alert("child_1 text="+e.target.children[0].innerHTML);
			//alert("child_2 oper="+e.target.children[1].innerHTML);
			//alert("child_3 text="+e.target.children[2].innerHTML);
// Check browser support
			/*sessionStorage.setItem("CaLLNumA", "");
			sessionStorage.setItem("CaLLOper", "");
			sessionStorage.setItem("CaLLNumB", "");
			
			sessionStorage.setItem("CaLLNumA", e.target.children[0].innerHTML);
			sessionStorage.setItem("CaLLOper", e.target.children[1].innerHTML);
			sessionStorage.setItem("CaLLNumB", e.target.children[2].innerHTML);
			
			//alert("SESSION numA= "+sessionStorage.getItem("CaLLNumA"));
			//alert("SESSION Oper= "+sessionStorage.getItem("CaLLOper"));
			//alert("SESSION numB= "+sessionStorage.getItem("CaLLNumB"));*/
		if(Lang=="Eng"){
			SetMissVals(e.target.children[0].innerHTML,e.target.children[1].innerHTML,e.target.children[2].innerHTML);
		}
		if(Lang=="Gre"){
			SetMissVals(e.target.children[0].innerHTML,e.target.children[1].innerHTML,e.target.children[3].innerHTML);
		}	
		}else{
			//alert("was UserMisstakesCont = "+e.target.id);
			//When user clicks inside the MisTBox clicks the number-elements
		if(Lang=="Eng"){
			SetMissVals(e.target.parentElement.children[0].innerHTML,e.target.parentElement.children[1].innerHTML,e.target.parentElement.children[2].innerHTML);
		}
		if(Lang=="Gre"){
			SetMissVals(e.target.parentElement.children[0].innerHTML,e.target.parentElement.children[1].innerHTML,e.target.parentElement.children[3].innerHTML);
		}
		
		}
		
		$( ".MisTBox" ).removeClass( "MissSelected" );
		$(this).addClass( "MissSelected" );
		//alert("ItemNumA= "+$(this).children("#ItemNumA").text()); 
}); 
//Super-Global function to Load Mistakes from any file of the webpage!
window.LoadMisstakes=function(pin){
		$( "#UserMisstakesCont" ).html("");
	  $.ajax({                                      
			url: 'GetUsermistakes.php',          
			data: {UserPin: pin},			   
			dataType: 'json',  	//data format 
			beforeSend : function()    {           
					//--007			
			},
			success: function(data)   
			{
				if(data.length!=0){
				
					//alert("data exists");	
					//alert("data="+ data[0]['NumA']+" "+data[0]['Oper']+" "+data[0]['NumB']);					
					//alert("data="+ data[1]['NumA']+" "+data[1]['Oper']+" "+data[1]['NumB']);	
				for (i = data.length; i >=0, i--;) {
				//for (i = 0; i < data.length; i++) {
					//alert("pin= "+pin);
					//alert("data="+ data[i]['NumA']+" "+data[i]['Oper']+" "+data[i]['NumB']);
					
				if(Lang=="Eng"){
					$("#UserMisstakesCont").append("<div class='MisTBox GreyBg' id='"+pin+"'>"+(i+1)+": <span id='ItemNumA'>"+data[i]['NumA']+"</span> <span id='ItemOper' class='ItemOper'>"+data[i]['Oper']+"</span> <span id='ItemNumB'>"+data[i]['NumB']+"</span><br></div>");
				}
				if(Lang=="Gre"){
					
					if(data[i]['Oper']=="plus"){
						var tempOper="σύν";
					}
					if(data[i]['Oper']=="minus"){
						var tempOper="πλήν";
					}
					if(data[i]['Oper']=="multy"){
						var tempOper="επί";
					}
					if(data[i]['Oper']=="divy"){
						var tempOper="διά";
					}
					$("#UserMisstakesCont").append("<div class='MisTBox GreyBg' id='"+pin+"'>"+(i+1)+": <span id='ItemNumA'>"+data[i]['NumA']+"</span> <span id='ItemOper' class='ItemOper' style='display:none;'>"+data[i]['Oper']+"</span><span id='tempOper' class='ItemOper'>"+tempOper+" </span><span id='ItemNumB'>"+data[i]['NumB']+"</span><br></div>");
				}
				
				}

					
					

					
				}else{
					
					//alert("data MISSING");	
				}

				//alert("LOAD MISTAKES");
				console.log("LOAD MISTAKES");
			}// end of success
			
			});//end of ajax


	}
//Super-Global function to Load Mistakes from any file of the webpage!
window.LoadScores=function(pin){
	
	
			$( "#UserScoresCont" ).html("");
	  $.ajax({                                      
			url: 'GetScores.php',          
			data: {UserPin: pin},			   
			dataType: 'json',  	//data format 
			beforeSend : function()    {           
					//--007			
			},
			success: function(data)   
			{
				if(data.length!=0){
				
					//alert("data exists");	
					//alert("data="+ data[0]['NumA']+" "+data[0]['Oper']+" "+data[0]['NumB']);					
					//alert("data="+ data[1]['NumA']+" "+data[1]['Oper']+" "+data[1]['NumB']);	
				for (i = data.length; i >=0, i--;) {
				//for (i = 0; i < data.length; i++) {
					//alert("pin= "+pin);
					//alert("data="+ data[i]['NumA']+" "+data[i]['Oper']+" "+data[i]['NumB']);
					
					if(Lang=="Eng"){
						$("#UserScoresCont").append("<div class='ScoresBox' id='"+pin+"'>Addition: <span id='PlusScores'>"+data[i]['ScorePlus']+"</span><br> Subtraction:<span id='MinusScores'>"+data[i]['ScoreMinus']+"</span> <br>Multiplication:<span id='multiScores'>"+data[i]['ScoreMulty']+"</span><br>Divition:<span id='divyScores'>"+data[i]['ScoreDivy']+"</span><br></div>");
					}
					if(Lang=="Gre"){
						$("#UserScoresCont").append("<div class='ScoresBox' id='"+pin+"'>Πρόσθεση: <span id='PlusScores'>"+data[i]['ScorePlus']+"</span><br> Αφαίρεση:<span id='MinusScores'>"+data[i]['ScoreMinus']+"</span> <br>Πολλαπλασιασμός:<span id='multiScores'>"+data[i]['ScoreMulty']+"</span><br>Διαίρεση:<span id='divyScores'>"+data[i]['ScoreDivy']+"</span><br></div>");
					}
				}
				}else{
					
					//alert("data MISSING");	
				}

				//alert("LOAD MISTAKES");
				console.log("LOAD scores");
			}// end of success
			
			});//end of ajax
};
//LoadScores(CurrentUser.Pin);
window.RestartLesson=function(){
	

	//alert("restart loop");
		  $.ajax({                                      
			url: 'Restart.php',      
			data: "pin="+CurrentUser.Pin,			   
			dataType: 'json',          
			beforeSend : function()    {           
					//--007	
			//alert("restart Before send");					
			},
			success: function(data)   
			{
				//alert("restart true data="+data);
					LoadMisstakes(CurrentUser.Pin);
					LoadScores(CurrentUser.Pin);

			}// end of success
			
		});//end of ajax	
	
};
window.Statictics=function(UserThis, thisMissCor){ //Statictics(UserThis, MissCor);
		
var d = new Date();
    
var Day = d.getDate();
var Month = d.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
var Year = d.getFullYear();	
		
		console.clear();
		console.log("UserThis= "+UserThis);
		console.log("MissCor= "+thisMissCor);
		console.log("Day= "+Day);
		console.log("Month= "+Month);
		console.log("Year= "+Year);
		//alert("Statistic STOP");
	  $.ajax({                                      
			url: 'PostUserStatictic.php',          
			data: {User: UserThis, MissCor: thisMissCor, day: Day, month: Month, year: Year},			   
			dataType: 'json',  	//data format 
			beforeSend : function()    {           
					//--007			
			},
			success: function(data)   
			{	
			//alert("Statistic SAVED = "+data);
				
			}// end of success
			
			});//end of ajax


	}

 });//ready
 
</script>

</html>					
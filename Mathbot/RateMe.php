 <!DOCTYPE html>
<html>
<head>
<?php
	$Que1="Was this page easy to use?";
	$Que2="Whats your chatbot experience?";
	$Que3="Have you practised your math skills?";
	$Que4="Was the WhiteBoard interface easy to use?";
	$Que5="Did you like the WhiteBoard?";
	$Que6="Rate this page, overall";


	$Que1Gre="Ήταν εύχρηστη ή σελίδα αυτή?";
	$Que2Gre="Ποιά είναι η άποψη σου για το chatbot?";
	$Que3Gre="Βελτιώθηκες στα μαθηματικά?";
	$Que4Gre="Ήταν το WhiteBoard εύκολο στην χρήση?";
	$Que5Gre="Σου άρεσε το WhiteBoard?";
	$Que6Gre="Γενικά, σου άρεσε η σελίδα?";

$Stars="
<span id='One' class='fa fa-star ClcStar' ></span>
<span id='Two' class='fa fa-star ClcStar'></span>
<span id='Three' class='fa fa-star ClcStar'></span>
<span id='Four' class='fa fa-star ClcStar'></span>
<span id='Five' class='fa fa-star ClcStar'></span>
";



?>
<script>

	$Que1=0;
	$Que2=0;
	$Que3=0;
	$Que4=0;
	$Que5=0;
	$Que6=0;
	
//Ajax to upload Use rates into database	

 $(function() {
	 $( ".ClcStar" ).on('click', function(e){
		 
		//alert( "this.id="+$(this).attr( "id" ));
		//alert( "this.parents=");
		var ThisAns =  $(this).parents( ".Rates" ).attr( "id" ); // Que1
		if(ThisAns=="Que1"){
			//alert( "Was Que1");
			$Que1=$(this).attr( "id" );
			$(this).parent().find("span").removeClass( "checked" );
			$(this).addClass( "checked" );
			$(this).prevAll().addClass( "checked" );
		}
		if(ThisAns=="Que2"){
			//alert( "Was Que2");
			$Que2=$(this).attr( "id" );
			$(this).parent().find("span").removeClass( "checked" );
			$(this).addClass( "checked" );
			$(this).prevAll().addClass( "checked" );
		}
		if(ThisAns=="Que3"){
			//alert( "Was Que3");
			$Que3=$(this).attr( "id" );
			$(this).parent().find("span").removeClass( "checked" );
			$(this).addClass( "checked" );
			$(this).prevAll().addClass( "checked" );
		}
		if(ThisAns=="Que4"){
			//alert( "Was Que4");
			$Que4=$(this).attr( "id" );
			$(this).parent().find("span").removeClass( "checked" );
			$(this).addClass( "checked" );
			$(this).prevAll().addClass( "checked" );
		}
		
		if(ThisAns=="Que5"){
			//alert( "Was Que5");
			$Que5=$(this).attr( "id" );
			$(this).parent().find("span").removeClass( "checked" );
			$(this).addClass( "checked" );
			$(this).prevAll().addClass( "checked" );
		}
		if(ThisAns=="Que6"){
			//alert( "Was Que6");
			$Que6=$(this).attr( "id" );
			$(this).parent().find("span").removeClass( "checked" );
			$(this).addClass( "checked" );
			$(this).prevAll().addClass( "checked" );
		}
		
//Ajax to upload Use rates into database	
/*			
		$.ajax({                                      
			url: 'GetUserActivity.php',          
			data: {UserPin: $( "#HiddenPin" ).val(),},			   
			dataType: 'json',  	//data format 
			beforeSend : function()    {           
					//--007	
				alert("Ready: Sending rates to database");					
			},
			success: function(data)   
			{
				
				
				
				alert(" data[ScorePlus]= "+ data['ScorePlus'] )
			}// end of success
			
			});//end of ajax	
		*/
		
		if(	$Que1!=0 && $Que2!=0 && $Que3!=0 && $Que4!=0 && $Que5!=0 && $Que6!=0 ){
			$( "#RateMe" ).html("<span class='Thanks'>Thank you for your feedback!</span>");//.hide();
			
			console.log("CurrentUser= "+$( "#HiddenPin" ).val());
			console.log("$Que1= "+$Que1);
			console.log("$Que2= "+$Que2);
			console.log("$Que3= "+$Que3);
			console.log("$Que4= "+$Que4);
			console.log("$Que5= "+$Que5);
			console.log("$Que6= "+$Que6);
			
			
			
//Ajax to upload Use rates into database	
			
		$.ajax({                                      
			url: 'UploadUserRates.php',          
			data: {UserPin: $( "#HiddenPin" ).val(), Que1: $Que1, Que2: $Que2, Que3:  $Que3, Que4: $Que4, Que5: $Que5, Que6: $Que6},			   
			dataType: 'json',  	//data format 
			beforeSend : function()    {           
					//--007	
				//alert("Ready: Sending rates to database");					
			},
			success: function(data)   
			{
				//alert(" XaXa="+ data )
			}// end of success
			
			});//end of ajax	
			
			
			
			
			
			
			
			
		}
	 });
	 
	 
	 
});



</script>
</head>
	<body>
	<div id="EngRates">
		<div id="Que1" class="Rates"><label><?php echo $Que1;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que2" class="Rates"><label><?php echo $Que2;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que3" class="Rates"><label><?php echo $Que3;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que4" class="Rates"><label><?php echo $Que4;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que5" class="Rates"><label><?php echo $Que5;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que6" class="Rates"><label><?php echo $Que6;?> </label><div><?php echo $Stars;?></div></div>
	</div>
	<div id="GreRates">
		<div id="Que1" class="Rates"><label><?php echo $Que1Gre;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que2" class="Rates"><label><?php echo $Que2Gre;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que3" class="Rates"><label><?php echo $Que3Gre;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que4" class="Rates"><label><?php echo $Que4Gre;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que5" class="Rates"><label><?php echo $Que5Gre;?> </label><div><?php echo $Stars;?></div></div>
		<div id="Que6" class="Rates"><label><?php echo $Que6Gre;?> </label><div><?php echo $Stars;?></div></div>
	</div>
	</body>
</html>	
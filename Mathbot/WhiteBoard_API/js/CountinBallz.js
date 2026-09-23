$(document).ready(function() {




for (i = 1; i < 10; i++) {
	  $("#Ais").append("<div  class='btn CountinBallz'><i class='fa fa-futbol-o nums' aria-hidden='true'><span></span></i></div>");
}
for (i = 10; i < 19; i++) {
	  $("#Bis").append("<div  class='btn CountinBallz'><i class='fa fa-futbol-o nums' aria-hidden='true'><span></span></i></div>");
}

window.AisCount=0;
window.BisCount=0;

$("#Ais").on('click', function(e) {
	if(AisCount==9){
		//alert("#Ais is Max");
	}else{
		AisCount+=1;
	}

	//Function
	CalcTotalBallz();
	//alert("AisCount= "+AisCount);
	/*
	for (i = 1;  i < AisCount+1; i++) {
		$("#Ais .CountinBallz").eq( i-1 ).find( "span" ).text( i );
		//alert("#Ais Ball clicked");
		$("#Ais .CountinBallz").eq( i-1 ).addClass("counted");
	}*/
	
	
});
// Right click
$("#Ais").contextmenu(function(event) {
	event.preventDefault();
	 //alert("Was context");
	 $("#Ais .CountinBallz").find( "span" ).text( "" );
	 $("#Ais .CountinBallz").removeClass("counted");
	 
	if(AisCount==1){
		//alert("#Ais is Minimum");
	}else{
		AisCount-=1;
	}
	//Function
	CalcTotalBallz();
	
	//alert("AisCount= "+AisCount);
	/*for (i = 1;  i < AisCount+1; i++) {
		$("#Ais .CountinBallz").eq( i-1 ).find( "span" ).text( i );
		//alert("#Ais Ball clicked");
		$("#Ais .CountinBallz").eq( i-1 ).addClass("counted");
	}*/
	
	
});
//Bis
$("#Bis").on('click', function(e) {
	if(BisCount==9){
		//alert("#Bis is Max");
	}else{
		BisCount+=1;
	}
	//Function
	CalcTotalBallz();

	
});
// Right click
$("#Bis").contextmenu(function(event) {
	event.preventDefault();
	 //alert("Was context");
	 $("#Bis .CountinBallz").find( "span" ).text( "" );
	 $("#Bis .CountinBallz").removeClass("counted");
	if(BisCount==1){
		//alert("#Bis is Minimum");
	}else{
		BisCount-=1;
	}
	CalcTotalBallz();
	//Function
	//alert("AisCount= "+AisCount);
	/*for (i = 1;  i < BisCount+1; i++) {
		$("#Bis .CountinBallz").eq( i-1 ).find( "span" ).text( i+AisCount );
		//alert("#Bis Ball clicked");
		$("#Bis .CountinBallz").eq( i-1 ).addClass("counted");
	}*/
	
	
});
window.CalcTotalBallz=function(){
$("#CountinBallz").css("visibility","visible");
$("#Ais .CountinBallz span").text( "" );
$("#Bis .CountinBallz span").text( "" );	
	$("#Ais .CountinBallz").removeClass("counted");
	$("#Bis .CountinBallz").removeClass("counted");
//alert("#Ais Ball AisCount="+AisCount);
//alert("#Ais Ball BisCount="+BisCount);
	for (i = 1;  i < AisCount+1; i++) {
		$("#Ais .CountinBallz").eq( i-1 ).find( "span" ).text( i );
		//alert("#Ais Ball clicked");
		$("#Ais .CountinBallz").eq( i-1 ).addClass("counted");
	}
	
	for (i = 1;  i < BisCount+1; i++) {

		$("#Bis .CountinBallz").eq( i-1 ).find( "span" ).text( i );
		//alert("#Bis Ball clicked");
		$("#Bis .CountinBallz").eq( i-1 ).addClass("counted");
	}
CalcKratu();
}
window.CalcKratu=function(){
//alert("CalcKratu AisCount="+AisCount);
//alert("CalcKratu BisCount="+BisCount);
	if(oper=="plus"){
		$(".Kratu label").text( "Carry" ).css("left","-10%");
		
		
		$("#root_cont").css("min-height","600px");
		$("#CountinBallz").css("top","50%");
		$(".Rdown label").text( "C:" ).css("left","-0%");
		
		
		//alert("CountinBallz was plus");
		if((AisCount+BisCount)>=10){
			//alert("exei kratoumeno");
			//Kratu
			$(".Kratu span").text( 1 );
			$(".Rdown span").text( AisCount+BisCount-10 );
			$(".Total span").text( AisCount+BisCount ).css("left","10%");
		}else{
			
			$(".Kratu span").text( 0 );
			$(".Rdown span").text( AisCount+BisCount );
			$(".Total span").text( AisCount+BisCount ).css("left","35%");
		}
	}
	if(oper=="minus"){
		$("#root_cont").css("min-height","650px");
		$("#CountinBallz").css("top","55%");
		$(".Kratu label").text( "Borrow" ).css("left","-30%");
		$(".Rdown label").text( "Sub:" ).css("left","0%");
		//alert("CountinBallz was minus");
		//alert("CountinBallz pre_NumA= "+pre_NumA);
		//alert("CountinBallz pre_NumB= "+pre_NumB);
		if(Number(pre_NumA)>Number(pre_NumB)){
			if((AisCount-BisCount)<0){
				//alert("exei kratoumeno");
				//Kratu
				$(".Kratu span").text( 1 );
				    
				$(".Rdown span").text( AisCount-BisCount+10 ).css("left","35%");
				$(".Total span").text( AisCount-BisCount+10 ).css("left","35%");
			}else{
				
				$(".Kratu span").text( 0 );
				$(".Rdown span").text( AisCount-BisCount-1 );
				$(".Total span").text( AisCount-BisCount ).css("left","35%");
			}
		
		}else{ //pre_NumB >> pre_NumA
			//alert("NumB is larger");
			//alert("BisCount B> ="+BisCount);
			//alert("AisCount B> ="+AisCount);
			if((BisCount-AisCount)<0){
				//alert("exei kratoumeno");
				//Kratu
				$(".Kratu span").text( 1 );
				    
				$(".Rdown span").text(BisCount-AisCount+10-1 ).css("left","35%");
				$(".Total span").text( BisCount-AisCount+10 ).css("left","35%");
			}else{
				
				$(".Kratu span").text( 0 );
				if((BisCount-AisCount)==0){
					$(".Rdown span").text( BisCount-AisCount-1 ).css("left","5%");
				}else{
					
					$(".Rdown span").text( BisCount-AisCount-1 ).css("left","35%");
					
				}
				$(".Total span").text( BisCount-AisCount ).css("left","35%");
			}
			
		}
	}
}



});//ready


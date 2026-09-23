let bot = new RiveScript({utf8: true});

const message_container = document.querySelector('.messages');
const form = document.querySelector('form');
const input_box = document.getElementById("userInput");
//To βασικο script για την λειτουργια του chatbot και SpeechRecognition
const brains = [
'chatbot/brain.rive',
'chatbot/SpeechRec.rive',
'chatbot/MathLesson.rive',
'chatbot/BasicResponse.rive',
'chatbot/VariableSetter.rive',
'chatbot/ChatLogIn.rive'

//'https://gist.githubusercontent.com/haralabos911/8328504c0157f3a806ef0ca1c5bb3bf6/raw/1a5a9b0d53b5fa6d1a59f8d303b6bfc157d6fb44/brain.rive'
	];

bot.loadFile(brains).then(botReady).catch(botNotReady);
let regexA1;
form.addEventListener('submit', (e) => {
  e.preventDefault();
  var UserInput =input_box.value;
  noteContent = '';
  
  regexA1 = new RegExp(/[+-]?([0-9]*[.])?[0-9]+/, "ig");
  $myMess = UserInput.match(regexA1);
  //alert("myMess="+$myMess);

  selfReply(original,UserInput);
  input_box.value = '';
});

/*
//When the bot speaks the question/answer to use input
function Speak(txt){
var msg = new SpeechSynthesisUtterance(txt);
msg.voice = speechSynthesis.getVoices().filter(function(voice) { return voice.name == 'Whisper'; })[0];
speechSynthesis.speak(msg);	
	
}*/
window.CntrMath01=0;

window.FlagsUsed=0;

function BotMathQ(){
	
if(CntrMath01==1){CntrMath01=0; return;}
	
var op = sessionStorage.getItem("Opera");
var num = sessionStorage.getItem("Number");
var Dify = sessionStorage.getItem("Dify");
//alert("BotMathQ");

// Based on User button choices
if(op=="any" || op=="τυχαία"){
	
	var myArray = ['Plus', 'Minus', 'Multi', 'Divy'];    
	var rand = myArray[Math.floor(Math.random() * myArray.length)];
	//alert("op= "+rand);
	op = rand;
}
if(num=="All" || num=="όλα"){
	
	var myArray = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];    
	var rand = myArray[Math.floor(Math.random() * myArray.length)];
	num = rand;
	
}
if(Dify=="easy" || Dify=="Εύκολο"){
	
	var random = Math.floor(Math.random() * 10)+1;
	
while (random==LastrandomWas){
	
	random = Math.floor(Math.random() * 10)+1;
	
}
	
	var LastrandomWas=random;
	
}
if(Dify=="hard" || Dify=="Δύσκολο"){

	var random = Math.floor(Math.random() * 20)+1;
	
while (random==LastrandomWas){
	
	random = Math.floor(Math.random() * 20)+1;
	
}
	
	var LastrandomWas=random;
}	
// Based on User button choices
	if(op=="Plus" || op=="Σύν"){
		var corSentence = Number(num)+" plus "+ Number(random);	
		var cor = Number(num) + Number(random);	
		
		sessionStorage.setItem("corSentence", ""+corSentence); //Sended to Brain.rive
		sessionStorage.setItem("cor", ""+cor); // Verify Brain responce
		
		console.log("Correct= "+cor);
	}
	if(op=="Minus" || op=="Πλήν"){
		var corSentence = Number(num)+" minus "+ Number(random);	
		var cor = Number(num) - Number(random);

		sessionStorage.setItem("corSentence", ""+corSentence); //Sended to Brain.rive		
		sessionStorage.setItem("cor", ""+cor); // Verify Brain responce
		console.log("Correct= "+cor);
	}
	if(op=="Multi" || op=="Επί"){
		var corSentence = Number(num)+" multiplied by "+ Number(random);
		var cor = Number(num) * Number(random);

		sessionStorage.setItem("corSentence", ""+corSentence);	//Sended to Brain.rive		
		sessionStorage.setItem("cor", ""+cor); // Verify Brain responce
		console.log("Correct= "+cor);
	}
	if(op=="Divy" || op=="Διά"){
		var corSentence = Number(num)+" Divided by "+ Number(random);
		var cor = Number(num) / Number(random);	
		console.log("Correct_OLD= "+cor);
		sessionStorage.setItem("corSentence", ""+corSentence);	//Sended to Brain.rive
		//cor = ((cor * 100) / 100).toFixed(2).toString(); //only 2 decimals+
		cor = cor.toFixed(2).toString(); //only 2 decimals+
		cor = Number(cor);
		console.log("Correct_NEW= "+cor);
		
		sessionStorage.setItem("cor", ""+cor);  // Verify Brain responce
		
	}
	if(Lang=="Eng"){
		
	var premessage="777abc "+corSentence;
	
	}
	if(Lang=="Gre"){
		
	var premessage="788abc "+corSentence;
	
	}
	
	
	//alert("premessage= "+premessage);
	//Use RiveScript to fetch the Question to be asked of the user
	bot.reply("local-user",premessage ).then(function(reply) {
		readOutLoud(reply,$control);
		//Speak(reply); //Activate SpeechSynthesis
		//alert("111 reply= "+reply);
		
		var FromGreToEng = sessionStorage.getItem("FromGreToEng");
		//alert("FromGre-->ToEng= 111 "+FromEngToGre);
		if(FromGreToEng=="true"){
			sessionStorage.setItem("FromGreToEng", "false"); 
			//alert("FromGre-->ToEng= 222 "+FromEngToGre);
			message_container.innerHTML += '<div class="bot">I must respond in english as well!</div>';
		}
		
		var FromEngToGre = sessionStorage.getItem("FromEngToGre");
		//alert("FromEng-->ToGre= 111 "+FromEngToGre);
		if(FromEngToGre=="true"){
			sessionStorage.setItem("FromEngToGre", "false");
			//alert("FromEng-->ToGre= 222 "+FromEngToGre);
			message_container.innerHTML += '<div class="bot">θα σου απαντήσω στα ελληνικά και εγώ!</div>';
		}
		message_container.innerHTML += '<div class="bot">'+reply+'</div>';
	
	});
}

//Bot
function botReply(message){
	//--here___
	readOutLoud(message,$control);
	//Speak(message);
	message_container.innerHTML += '<div class="bot">'+message+'</div>';// Bot chat Box
	BotMathQ(CntrMath01); // Bot continues with lesson
}

//User Box
function selfReply(original,message){ //User typed
  message_container.innerHTML += '<div class="self">'+original+'</div>';
 
//------start

  message = [...String(message).split("-").join("minus ")];
  message = String(message).replace(/,/g, "");
  //Contact the bot, pass the User's input to the bot. Await responce
  //alert("333 message= "+message)
	bot.reply("local-user", message).then(function(reply) {  // User Input
	//alert("222 reply= "+reply);
		botReply(reply); //Bot response to the User Input
		//document.querySelector(".chat").scrollTo(0,document.querySelector(".chat").scrollHeight+55);
setTimeout(function(){ 
	console.log("scrollHeight="+(document.querySelector('.chat').scrollHeight)); 
	console.log("scrollHeight="+(document.querySelector('.chat').scrollHeight + 55)); 
	document.querySelector(".chat").scrollTo(0,(document.querySelector(".chat").scrollHeight));

}, 500);
	});
}
window.Lang="Eng";
//Conversation initiation
function botReady(){
	//alert("hello 444");
message_container.innerHTML ="";
	
if(Lang=="Eng"){
	bot.sortReplies();
  
  	message_container.innerHTML += '<div class="bot">Hello my name is Mathew</div>';
	message_container.innerHTML += '<div class="bot">Lets do some homework on math, okey!</div>';
}else{
	bot.sortReplies();
  
  	message_container.innerHTML += '<div class="bot">Γειά σου, το όνομα μου είναι Ματθαίος</div>';
	message_container.innerHTML += '<div class="bot">πάμε να κάνουμε λίγα μαθηματικά</div>';
}
}


function botNotReady(err){
  console.log("An error has occurred.", err);
}
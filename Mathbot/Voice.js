try {
  var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  var recognition = new SpeechRecognition();
}
catch(e) {
  console.error(e);
  $('.no-browser-support').show();
}

//All speech recognition/synthesis function code!


//var noteTextarea = $('#userInput');  //here <-----
var noteTextarea = $('.actions #userInput');  //here <-----
var instructions = $('#recording-instructions');
var notesList = $('ul#notes');

var noteContent = '';

// Get all notes from previous sessions and display them.
//var notes = getAllNotes();
//renderNotes(notes);

/*-----------------------------
      Voice Recognition 
------------------------------*/

// If false, the recording will stop after a few seconds of silence.
// When true, the silence period is longer (about 15 seconds),
// allowing us to keep recording even when the user pauses. 
recognition.continuous = true;

// This block is called every time the Speech APi captures a line. 
recognition.onresult = function(event) {

  // event is a SpeechRecognitionEvent object.
  // It holds all the lines we have captured so far. 
  // We only need the current one.
  var current = event.resultIndex;

  // Get a transcript of what was said.
  var transcript = event.results[current][0].transcript;
//Good <---------
  // Add the current transcript to the contents of our Note.
  // There is a weird bug on mobile, where everything is repeated twice.
  // There is no official solution so far so we have to handle an edge case.
  var mobileRepeatBug = (current == 1 && transcript == event.results[0][0].transcript);

  if(!mobileRepeatBug) {
    noteContent += transcript;
	document.getElementById("userInput").value = noteContent;
    noteTextarea.val(noteContent);
  }//Good <---------
};

recognition.onstart = function() { 
  //instructions.text('Voice recognition activated. Try speaking into the microphone.');
  //alert("Voice recognition activated. Try speaking into the microphone.'");
  $("#voiceInput").addClass( "VoiceActive" );
  $Rec=true;
}

recognition.onspeechend = function() {
  //instructions.text('You were quiet for a while so voice recognition turned itself off.');
   //alert('You were quiet for a while so voice recognition turned itself off.');
   $("#voiceInput").removeClass( "VoiceActive" );
   $Rec=false;
}

recognition.onerror = function(event) {
  if(event.error == 'no-speech') {
    instructions.text('No speech was detected. Try again.');  
  };
}



/*-----------------------------
      App buttons and input 
------------------------------*/

$('#start-record-btn').on('click', function(e) {
  if (noteContent.length) {
    noteContent += ' ';
  }
  recognition.start();
});


$('#pause-record-btn').on('click', function(e) {
  recognition.stop();
  noteContent = '';
  instructions.text('Voice recognition paused.');
});

// Sync the text inside the text area with the noteContent variable.
	noteTextarea.on('input', function() {
	noteContent = $(this).val();
})

/*-----------------------------
      Speech Synthesis 
------------------------------*/
// readOutLoud(text);
function readOutLoud(message,control) {
	if(control && Lang=="Eng"){
		var speech = new SpeechSynthesisUtterance();

	  // Set the text and voice attributes.
		speech.text = message;
		speech.volume = 1;
		speech.rate = 1;
		speech.pitch = 1;
	  
		window.speechSynthesis.speak(speech);
	}else{
		console.log("SpeachSynthesis is deactivated for now");
	}
}
//readOutLoud("hello world",control);








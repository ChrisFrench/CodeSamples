<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no">
<style type="text/css">
body { 

	font-family:arial;
	color:#444;
	padding:20px;
       overflow:hidden;

	background: #000;

}
.active { background:green; color:#fff; }
h1 { line-height:20px; margin:10px 0px 0px 0px; }
h2 { font-size:1.1em; font-weight:300;  margin:10px 0px 0px 0px; }
ul { list-style:none; margin:0px;padding:0px;}
li { list-style:none; }
button {
 border-radius:20px;
 width:100%;
 padding:5px;
 border:0px;
 height:20%;
 background:#370bff;
 color:#fff;
 margin-bottom:4%;
 font-weight:bold;
 font-size:5em;
}

button:disabled {
 border-radius:20px;
 width:100%;
 padding:5px;
 border:0px;
 height:20%;
 background:#5e1e59;
 color:#fff;
 margin-bottom:4%;
 font-weight:bold;
 font-size:5em;
}
#scoreWrapper {

margin:0px;
height:5%;
min-height:40px;
margin-bottom:5px;
}

#score {
   width:100%;
   color:#fff;
   padding:10px;
   border-radius:10px;
   border:0px;
   background:rgba(255,255,255,0.2);
   text-align:center;
}
.green { background:green!important; }
.red { background:red!important; }
#overlay {
   color:#fff; 
   font-size:2em;
   padding-top:30%;
   display:none;
   width:100%;
   height:100%;
   position:absolute;
   background:rgba(0,0,0,0.7);
   text-align:center;
}

</style>
</head>
<body>
<div id="start">
<button id="startButton"> START GAME</button>
</div>

<div id="game" style="display: none;">

<div id="overlay">

</div>
<div id="scoreWrapper"><input id="score" disabled="disabled" value='Score: 0' data-score='0'></div>

<div class="controller">
<button id="a" data-answer="a" class="controllerButton">
A</button>
<button id="b" data-answer="b" class="controllerButton">
B</button>
<button id="c" data-answer="c" class="controllerButton">
C</button>
<button id="d" data-answer="d" class="controllerButton">
D</button>
</div>
</div>



<div class="footer" style="position:absolute; bottom:0;">
<a href="">END GAME</a></div>


<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };


	
    var pusher = new Pusher('<?php echo $this->pusher->getPublicKey();?>');

    var privchannel = pusher.subscribe('private-<?php echo $user->{'experience.device_id'}; ?>-<?php echo $user->id; ?>');

	privchannel.bind('pusher:subscription_succeeded', function(data) {
	

	$('#startButton').click( function() {

		var triggered = privchannel.trigger('client-startbutton', {  });
		$('#start').fadeOut('fast');
	    $('#game').fadeIn('fast');
	 
	});
	
	});

	$('.controllerButton').click( function() {


		var triggered = privchannel.trigger('client-answer', { answer: $(this).data('answer') });
	       $('#overlay').fadeIn('fast');
		
	});
	



	privchannel.bind('client-response', function(data) {
		cur = parseInt($('#score').data('score'));
		score = parseInt(data.value);
		if (score !==0) { 

		$('#score').toggleClass('green');
		  setTimeout( function() {
   		    $('#score').toggleClass('green');
		  },300);

              } else {

		$('#score').toggleClass('red');
		  setTimeout( function() {
   		    $('#score').toggleClass('red');
		  },300);

		}
              $('#score').data('score', ( cur + score) );
		$('#score').val('Score: ' + (cur + score));
		
	
		$('#overlay').fadeOut('fast');
		
	});

	privchannel.bind('client-gameover', function(data) {
		cur = parseInt($('#score').data('score'));

		   $('#overlay').html('<h2>Game Over!</h2>').fadeIn('fast');
		
	});

	privchannel.bind('client-started', function(data) {
		
		
	});


	

  </script>
</body>
</html>
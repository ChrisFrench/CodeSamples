<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Trivia</title>
<style type="text/css">
body { 

	font-family:arial;
	color:#fff;
	padding:20px;
	background: rgba(0,0,0,0.9);

}
.true { background:green; color:#fff; }
.false { background:red; color:#fff; }
h1 { line-height:20px; margin:10px 0px 0px 0px; }
h2 { font-size:1.1em; font-weight:300;  margin:10px 0px 0px 0px; }
ul { list-style:none; margin:0px;padding:0px;}
li { list-style:none; }
.q { 
	font-weight:bold;
	font-size:1.8em;
	padding:20px; 
	background:rgba(255,255,255,0.1);
	border-radius:5px;
}
.a { 
	margin-top:5px;
	font-weight:bold;
	font-size:1em;
	padding:20px; 
	border:1px solid rgba(255,255,255,0.1);
	border-radius:5px;

}
.letter {
	display:inline-block;
	padding:15px;
	width:20px;
	font-size:1.8em;
	font-weight:bold;
	border-radius:5px;
	background:#370bff;
}
.answer {
	display:inline-block; 
	font-size:1em;
	line-height:1.2em;
	word-wrap: break-word!important;
	padding:0px 0px 0px 10px;
}
#top {
	width:100%;
	background:#000;
	text-align:center;
	border-radius:20px;
	margin-bottom:10px;
}
</style>
</head>
<body>
<div id="top">
<img src="/Innovation/img/trivia.png">
</div>
<div id="waiting" >
<h1  style="text-align: center; margin-top:35px;">PLEASE TAP YOUR RYSTBAND TO PLAY</h1>
</div>
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
<script src="/sys/pusher.js" type="text/javascript"></script>
<script type="text/javascript">

    // Enable pusher logging - don't include this in production
    
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };

   

    var pusher = new Pusher('<?php echo $this->pusher->getPublicKey();?>');
    
    var channel = pusher.subscribe('<?php echo $experience->{'device_id'}; ?>');
    channel.bind('play', function(data) {
    	location.reload();
    });



	// Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };
    
    channel.bind('badTag', function(data) {
        alert('TAG INVALID');
      });
    channel.bind('noAttendee', function(data) {
        alert('NO ATTENDEE');
      });
    channel.bind('alreadyPlayed', function(data) {
        alert('You already Played');
      });
   
  </script>
</body>
</html>
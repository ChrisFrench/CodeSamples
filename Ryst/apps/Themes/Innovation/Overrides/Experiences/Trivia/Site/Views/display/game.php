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
h2 { font-size:1.6em; font-weight:300;  margin:10px 0px 0px 0px; }
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
.column {
text-align: center;
width:30%;
float:left;
border: 2px solid #fff;
margin: 5px;
}
</style>
</head>


<?php  $user = (new \Rystband\Models\Users)->setState('filter.id', $experience->{'player.attendee'})->getItem()?>
<body>
<div id="top">
<img src="/Innovation/img/trivia.png">
</div>
<div id="waiting" style="text-align: center; margin-top:135px;">

<h1>Hi, <span id="username"><?php echo ucfirst($user->first_name); ?></span> please check your phone.</h1><h2>Your Rystband has texted you...</h2><br/><br/>
<img src="/Innovation/img/sendtophonenew.gif">
</div>

<div id="holder"></div>
<?php  if (!empty($experience->game)) {
		$game = (new \Experiences\Trivia\Models\Games)->setState('filter.id', $experience->game)->getItem();
	
			if (!empty($game->categories))
			{
				foreach ($game->categories as $cat)
				{
					if ($results = (new \Experiences\Trivia\Models\Questions())->setState('filter.category.id', $cat['id'])->getList())
					{
						foreach ($results as $result)
						{
							$questions[(string) $result->id] = $result;
						}
					}
				}
			}
		}
?>

<?php  if (!empty($game->id) && !empty($questions)) : ?>
<div id="questions" style="display:none;">
<?php
$i =1;
foreach($questions as $key => $question) :?>
<ul <?php 
if($i > 1) { echo 'style="display:none;"';}; ?> id="question<?php echo $i; ?>">
<li class="q"><?php echo $question->question; ?>?</li>
	<ul class="answers ">
		<?php //TODO make this smarter 
		$answers = array('a','b','c','d');
?>
		<?php foreach($question->answers as $key => $answer) :?>
		<?php if(!empty($answer['text'])) : ?>
		<li id="<?php echo array_shift($answers)?>" class="a" style="padding:10px" data-qid="<?php echo $i;?>"  style="display:block!important;" data-id="<?php echo $question->id?>"  data-key="<?php echo $key; ?>" data-value="<?php echo $answer['value']; ?>" ><span class="letter"><?php echo $key;?></span><p class="answer"><?php echo $answer['text']; ?></p></li>
		<?php endif; ?>
		<?php endforeach;?>
	</ul>

</ul>

<?php $i++; endforeach;?>
</div>
<?php else : ?>
NO GAME IS ATTACHED
<?php endif; ?>
<div id="gameOver" style="display:none;">
Great Job, We are submitting your scores...<br>
<div id="overSuccess" style="display:none;">
Your Score has been saved!
</div>

</div>

<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
<script src="/sys/pusher.js" type="text/javascript"></script>
<script type="text/javascript">
var q=1;
var questions=<?php echo count($questions);?>

var answers = {};
var seconds=5;
var timer;
var id = 0;
var nid;
    // Enable pusher logging - don't include this in production
    
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };

    function finishGame() {
		//clearTimer();
		//$('#timer').hide();
		
		$('#questions').html('<h1>GREAT JOB! We are submitting your scores.</h1><br>');
		
			$.ajax({
				  type: "POST",
				  url: 'http://ryst.cc/experience/trivia/game/<?php echo $game->id; ?>',
				  data: {'answers':answers, 'experience': '<?php echo (string) $experience->_id; ?>', 'player': '<?php echo  $experience->{'player.attendee'}; ?>'},
				  success: function(data) {

					  $('#overSuccess').show();

					  setTimeout(function(){location.reload();}, 5000);
						
					  
					  },
				  dataType: 'json'
				});
	}


	

    var pusher = new Pusher('<?php echo $this->pusher->getPublicKey();?>');

	var privchannel = pusher.subscribe('private-<?php echo $experience->{'device_id'}; ?>-<?php echo $experience->{'player.attendee'}; ?>');

	privchannel.bind('pusher:subscription_succeeded', function(data) {
		
	});

	privchannel.bind('client-startbutton', function(data) {
	  	  $('#waiting').hide();
	  	 $('#questions').show();  	  			
	  	
	});
	
	privchannel.bind('client-answer', function(data) {
		nid=id+1;
		answers[$('#question'+ q + ' #' + data.answer).data('id')] = $('#question'+ q + ' #' + data.answer).data('key');
		//$('#holder').append(data.answer);
	/*
		$('.a').removeClass("true");
		$('.a').removeClass("false");
		if ( $('#question'+ q + ' #' + data.answer).data('value') > 0) {
		  $('#question'+ q + ' #' + data.answer).toggleClass("true");
		} else {
		  $('#question'+ q + ' #' + data.answer).toggleClass("false");
		}
		 
	*/
		var triggered = privchannel.trigger('client-response', { value: $('#question'+ q + ' #' + data.answer).data('value') });

		
		setTimeout(function() {
		
		$('#question' + q).fadeOut();
		q++;
		console.log('q: ' + q + ' questions: ' + questions);
		if(q > questions) {
			
			console.log('sending game over');
			var triggered = privchannel.trigger('client-gameover', { value: $('#question'+ q + ' #' + data.answer).data('value') });
			finishGame();
		

		} else {
			$('#question' + q).fadeIn();
	
		}
		
	       },500);				
     
		});

	
	
    
    var channel = pusher.subscribe('<?php echo $experience->{'device_id'}; ?>');

    channel.bind('play', function(data) {

  	  $('#username').html(data.attendee.first_name);	
  	  $('#resting').hide();  
  	  $('#waiting').show();  	
		 	  
    });


	

    
    channel.bind('badTag', function(data) {
        alert('TAG INVALID');
      });
    channel.bind('noAttendee', function(data) {
        alert('NO ATTENDEE');
      });

    channel.bind('noAttendee', function(data) {
        alert('NO ATTENDEE');
      });
  </script>
</body>
</html>
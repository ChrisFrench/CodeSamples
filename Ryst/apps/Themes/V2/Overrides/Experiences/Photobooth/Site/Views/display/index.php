<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Photo Booth</title>
        
        <!-- Our CSS stylesheet file -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />
        <link rel="stylesheet" href="/V2/photo/assets/css/styles.css" />
        <link rel="stylesheet" href="/V2//photo/assets/countdown/jquery.countdown.css" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    
    <body>
		<div class='flashDiv'></div>
		<header><h1>Tap your rystband to take photo.</h1></header>
		<div id="countdown"></div>


        <!-- JavaScript includes -->
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="/V2/photo/assets/countdown/jquery.countdown.js"></script>
		<script src="/V2/photo/assets/js/script.js"></script>
		<script src="http://js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(function(){


			$('.flashDiv').hide();


			var flashed =0;
			
			function flash(){
		             console.log('flash called!');
		             $('.flashDiv')
		             .show()  //show the hidden div
		             .animate({opacity: 2}, 400) 
		             .fadeOut(300)
		             .css({'opacity': 1});
			     
			}
			
			
			    // Enable pusher logging - don't include this in production
		    Pusher.log = function(message) {
		      if (window.console && window.console.log) {
		        window.console.log(message);
		      }
		    };

		    var pusher = new Pusher('<?php echo $experience->{'pusher.public'}?>');
		    var channel = pusher.subscribe('photobooth');
		    channel.bind('begin', function(data) {
			var ts = (new Date()).getTime() + 6*1000;
			$('header h1').html('Get Ready ' + data.attendee.first_name + '...');
		    $('#countdown').countdown({
				timestamp	: ts,
				callback	: function(days, hours, minutes, seconds){
					
					var message = "";
					

					message += seconds + " second" + ( seconds==1 ? '':'s' ) + " <br />";
					if (seconds==1 ) {
					$('header h1').html('Say CHEESE!');
					}
					if (seconds==0 ) {
					
		      				flash();
						flashed=1;
					
						$('header h1').html('<small>Please wait while we load your photo...</small>');			
						$('#countdown').html('');$('flashDiv').hide();

					} else {
					
					}
				}
			});
		    
		    
		    });

		    channel.bind('photo', function(data) {
		    	//should have a data.photo attribue with a value of upload/imagename.jpg


			$('header h1').html('<img src="' + data.photo + '?x=' + Math.random() + '">');
			$('#countdown').html('');$('flashDiv').hide();
			
		    });
			
			
			
		});
				

		</script>
    </body>
</html>
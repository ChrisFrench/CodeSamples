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

    var pusher = new Pusher('5b98106a361e7ee3d043');
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

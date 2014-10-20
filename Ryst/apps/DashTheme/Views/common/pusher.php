

<?php //echo \Dsc\Debug::dump( $this->app->hive(), false ); ?>

    <script src="http://js.pusher.com/2.1/pusher.min.js" type="text/javascript"></script>
<script>
  

    var pusher = new Pusher('349ec13c5950c62522ea');
    var channel = pusher.subscribe('<?php echo \Base::instance()->get("eventid");?>');

    console.log('<?php echo \Base::instance()->get("eventid");?>');

    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };

    // Update Wristband Total
	channel.bind('updateWbTotal', function(data) {
	  $('.wbTotal').html(data.message);
	});

    // Update Wristband Available
	channel.bind('updateWbAvailable', function(data) {
	  $('.wbAvailable').html(data.message);
	});

    // Update Attendee Total
	channel.bind('updateATotal', function(data) {
	  $('.aTotal').html(data.message);
	});

    // Update Attendee Available
	channel.bind('updateAAvailable', function(data) {
	  $('.aAvailable').html(data.message);
	});


    // Update Ticket Total
	channel.bind('updateTTotal', function(data) {
	  $('.tTotal').html(data.message);
	});

    // Update Ticket Available
	channel.bind('updateTAvailable', function(data) {
	  $('.tAvailable').html(data.message);
	});

    // Update Empty Total
	channel.bind('updateETotal', function(data) {
	  $('.eTotal').html(data.message);
	});


   // Activity

    // Create Activity
	channel.bind('createActivity', function(data) {
		console.log(data);
		console.log('create new activity');
		    $( "#blank-activity" ).attr('data-id',data.id).clone().prependTo( "#activity-log" ).attr('id','');
		    $('[data-id='+ data.id +']').find('.msg').html(data.message);
		    $('[data-id='+ data.id +']').find('.timestamp').html(data.timestamp);
		    $('[data-id='+ data.id +']').find('.name').html(data.name);

		switch(data.type) {

		  case 'prize':
		    $('[data-id='+ data.id +']').find('.message-img').addClass('icon-gift');
		    $('[data-id='+ data.id +']').attr('data-type',data.type);
		  break;

		  case 'attendee':
		    $('[data-id='+ data.id +']').find('.message-img').addClass('icon-check');
		    $('[data-id='+ data.id +']').attr('data-type',data.type);
		  break;

		  case 'user':
		    $('[data-id='+ data.id +']').find('.message-img').addClass('icon-user');
		    $('[data-id='+ data.id +']').attr('data-type',data.type);
		  break;

		  case 'ticket':
		    $('[data-id='+ data.id +']').find('.message-img').addClass('icon-headphones');
		    $('[data-id='+ data.id +']').attr('data-type',data.type);
		  break;

		}

	});



</script>
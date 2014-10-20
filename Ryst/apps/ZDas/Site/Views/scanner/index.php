<br>
<br>
<br>
<form method="post">
<fieldset>
	    <legend>Band ID: </legend>
	    <input type="text" id="bandid" name="bandid">
	  </fieldset>
<fieldset>
		<legend>User Details </legend>
	    <label>First Name: </label>
	    <input type="text" id="first_name" name="first_name" autofocus>
		<label>Last Name: </label>
	    <input type="text" id="last_name" name="last_name" autofocus>
		<label>Phone: </label>
	    <input type="text" id="phone" name="phone" autofocus>
		<label>Email: </label>
	    <input type="text" id="email" name="email" autofocus>
		
		<input type="submit" value="Register" class="button">
		
	  </fieldset>
	  
	  </form>

<?php \Dsc\System::instance()->get('session')->set('barcoderedirect', '/das/vipregister/scanner/'. $this->app->get('PARAMS.channel')); ?>

<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>

<script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };

    var pusher = new Pusher('<?php echo $this->pusher->getPublicKey(); ?>');
    var channel = pusher.subscribe('<?php echo $channel; ?>');
    channel.bind('tapped', function(data) {
        
        $('#bandid').val(data.bandid);
        $('#first_name').focus();
    
    });
</script>
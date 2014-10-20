<a href="/das/tap" class="home">Home</a>
	<div id="wrapper">
	  <fieldset>
	  <legend><b>VIP Profile</b></legend>
	  <h3><?php echo $attendee->fullName();?></h3>
	  <!--<p class="alt">Band Id: <?php echo $attendee->tagid;?> </p>-->
	  <?php if($attendee->phone):?>
	  <a data-href="/das/attendee/sendsms/<?php echo $attendee->id;?>" class="ajax button">Send SMS</a>
	  <?php endif;?>
	  <?php if($attendee->email):?>
	  <a data-href="/das/attendee/sendemail/<?php echo $attendee->id;?>" class="ajax button">Send Email</a>
	   <?php endif;?>
	  </fieldset>
	  <form action="">
	  <fieldset>
	    <!-- these should auto-save via ajax calls -->
	    <legend>Perks Received</legend>
             <div style="box-sizing:box-content;">
	      <label class="checkbox perk" data-name="merch"><input type="checkbox" <?php if($attendee->{'perks.merch'}){ echo 'checked="checked" disabled="disabled"' ;}?>>Merch Item</label>
	      <label class="checkbox perk" data-name="sunglasses"><input type="checkbox" <?php if($attendee->{'perks.sunglasses'}){ echo 'checked="checked" disabled="disabled"';}?>>Sunglasses</label>
	      <label class="checkbox perk" data-name="water1"><input type="checkbox" <?php if($attendee->{'perks.water1'}){ echo 'checked="checked" disabled="disabled"';}?>>Water Bottle #1</label>
	      <label class="checkbox perk" data-name="water2"><input type="checkbox" <?php if($attendee->{'perks.water2'}){ echo 'checked="checked" disabled="disabled"';}?>>Water Bottle #2</label>
	      <label class="checkbox perk" data-name="dinner"><input type="checkbox" <?php if($attendee->{'perks.dinner'}){ echo 'checked="checked" disabled="disabled"';}?>>Dinner</label>
             </div>
	  </fieldset>
	<!--  <fieldset>
	    <legend>Profile</legend>
	    <form method="POST" action="/das/profile/update">
	      <input type="hidden" name="id" value="<?php echo $attendee->id;?>">
	      <input type="text" name="email" placeholder="email" id="email">
	      <input type="text" name="phone" placeholder="phone" id="phone">
	      <input type="submit" value="Save" class="button">
	     </form>
	  </fieldset>
	  </form>
        -->
	</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">
	$( document ).ready(function() {
		  $('.ajax').click(function() {
			text = $(this).text();
			$(this).text('Sending...');
			$.get( $(this).data('href'), function( data ) {
				  
				  
				}); 
			$(this).text(text); 
			
		  });

		  $('.perk').click(function() {



			$.ajax({
			  type: "POST",
			  url: "/das/attendee/perks",
			  data: { perk: $(this).data('name'), id: "<?php echo $attendee->id;?>" }
			})
			.done(function( msg ) {
		    		console.log(msg);
			});
				
			  
		  });
	});

	
	

	
	</script>
	
	
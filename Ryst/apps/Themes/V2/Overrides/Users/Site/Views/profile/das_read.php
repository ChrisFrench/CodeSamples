<a href="/das/tap" class="home">Home</a>
	<div id="wrapper">
	  <fieldset>
	  <legend><b>VIP Profile</b></legend>
	  <h3><?php echo $attendee->fullName();?></h3>
	  <p class="alt">Band Id: <?php echo $attendee->tagid;?> </p>
	  <a href="#" class="button inline">Send SMS</a>
	  <a href="#" class="button inline">Send Email</a>
	  </fieldset>
	  <form action="">
	  <fieldset>
	    <!-- these should auto-save via ajax calls -->
	    <legend>Perks Received</legend>
	      <label class="checkbox"><input type="checkbox" value="0" name="shirt">T-Shirt</label>
	      <label class="checkbox"><input type="checkbox" value="0" name="shirt">Energy Drink</label>
	      <label class="checkbox"><input type="checkbox" value="0" name="shirt">Dinner</label>
	  </fieldset>
	  <fieldset>
	    <legend>Profile</legend>
	      <input type="text" placeholder="email" id="email">
	      <input type="text" placeholder="phone" id="phone">

	     
	      <input type="submit" value="Save" class="button">
	  </fieldset>
	  </form>
	</div>

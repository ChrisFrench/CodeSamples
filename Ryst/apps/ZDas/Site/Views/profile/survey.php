<br>
<br>
<br>
<?php if(!empty($_GET['saved'])) : ?>
<div id="wrapper">
	  <fieldset>
	  <legend>Thank You, Your profile is complete! Welcome to</legend>
	    <div class="intro"></div>
	  </fieldset>
	  <form >
	  <fieldset>
	   
	   </fieldset>
	  </form>
	</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready( function() {

  var a=navigator.onLine;
   if(a){
   console.log('online');
    } else {
   console.log('offline');
   }
 });
</script>
<?php else  : ?>
<form method="post" action="/das/survey/save">
<fieldset>
		<legend>Survey </legend>
	    <label>First Name: </label>
	    <input type="text" id="first_name" name="first_name" value="<?php echo $attendee->first_name;?>">
		<label>Last Name: </label>
	    <input type="text" id="last_name" name="last_name" value="<?php echo $attendee->last_name;?>" >
		<label>Phone: </label>
	    <input type="text" id="phone" name="phone" value="<?php echo $attendee->phone;?>" >
		<label>Email: </label>
	    <input type="text" id="email" name="email" value="<?php echo $attendee->email;?>" >
		<label>What Previous V2 Shows Have You Attended? </label>
	    <input type="text" id="previous" name="previous" value="<?php echo $attendee->previous;?>" >
		
		
		
		<input type="hidden" id="tagid" name="tagid" value="<?php echo $tag->tagid;?>" >
		<input type="submit" value="Submit" class="button">
		
	  </fieldset>
	  
	  </form>
<?php endif; ?>


<form method="post" action="/das/vipregister/scanner/user">
<fieldset><h3>This band has not yet been activated you can do so below.</h3>
	    <legend>Band ID: </legend>
	    <input type="text" id="bandid" name="bandid" value="<?php echo $this->app->get('PARAMS.tagid');?>">
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

<?php \Dsc\System::instance()->get('session')->set('barcoderedirect', '/b/'. $this->app->get('PARAMS.tagid')); ?>




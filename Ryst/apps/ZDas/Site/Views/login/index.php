<div id="wrapper">
	  <fieldset>
	  <legend>Welcome to</legend>
	    <div class="intro"></div>
	  </fieldset>
	  <form method="post">
	  <fieldset>
	    <legend>Login</legend>
	    <input type="text" name="email" placeholder="email" id="email">
	    <input type="submit" value="login" class="button">
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

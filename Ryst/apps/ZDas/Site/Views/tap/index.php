<style>
.stations  { list-style:none; margin-left: 0; padding-left: 0px;}
.stations li { list-style:none; margin-left: 0;}
.stations li a{ margin-left: 0;}
</style>

<div id="wrapper">
	<fieldset>
	<legend>Welcome to</legend>
	<div class="intro"></div>
	</fieldset>
	<fieldset>
	<legend>Tap a Band...	</legend>
       	<!-- // -->
	</fieldset>
	
	<fieldset>
	<legend>Connect to SmartBox	</legend>
     <ul class="stations">
     <li><a class="button" href="/das/tap/watch/000072921ab1">Station 1</a></li>
     <li><a class="button" href="/das/tap/watch/00008dd18ca2">Station 2</a></li>
     <li><a class="button" href="/das/tap/watch/0000123c723a">Station 3</a></li>
     <li><a class="button" href="/das/tap/watch/000014b96af4">Station 4</a></li>
     </ul>
	</fieldset>
	</div>
	<div class="more">
	  <a href="#" id="expand">...</a>
	  <div id="more-menu">
	   <a href="/logout">Logout</a>
	  </div>
	</div>
	<script type="text/javascript" src="/V2/js/jquery.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready( function() { 

	  $('#expand').click( function(e) {
	    
	    e.preventDefault();
	    $('#more-menu').slideToggle();
	    
	  });
	
	});
	</script>
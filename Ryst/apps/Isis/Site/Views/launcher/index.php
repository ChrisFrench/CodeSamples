


<h1>ISIS Example Emulation Page.</h1>

<h3>Test Spin to win Experiences. </h3>

<a target="_blank" href="http://ryst.cc/e/isisinnovationforum/examplespin1">Open Spin to Win page by clicking here.</a>
<br><br>
<button id="spintowin">Press to Emulate Spin To win, Not Registered.</button>
<br><br>
<button id="spintowinWinner">Press to Emulate Spin To win, Winner.</button>
<br><br>
<button id="spintowinLoser">Press to Emulate Spin To win, Loser.</button>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script>

$( document ).ready(function() {
	$( '#spintowin' ).click(function() {
		$.get( "http://ryst.cc/isis/launchspintowin");
		});
	$( '#spintowinWinner' ).click(function() {
		$.get( "http://ryst.cc/isis/launchspinwinner");
		});
	$( '#spintowinLoser' ).click(function() {
		$.get( "http://ryst.cc/isis/launchspinloser");
		});
});
</script>
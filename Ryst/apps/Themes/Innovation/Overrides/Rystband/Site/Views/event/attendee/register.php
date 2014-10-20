Register



<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
<script src="/sys/pusher.js" type="text/javascript"></script>
<script type="text/javascript">
    // Enable pusher logging - don't include this in production
    
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };

    var pusher = new Pusher('<?php echo $this->pusher->getPublicKey();?>');
    var channel = pusher.subscribe('<?php echo $PARAMS['tagid'] ?>');
    channel.bind('start_game', function(data) {
      alert(data.message);
    });
    
  </script>


<?php echo \Dsc\System::instance()->renderMessages(); ?>
    <?php if(@$SESSION['user']) {
      $user = $SESSION['user'];
    } ?>

 <div class="pushdown" style="padding:10px;margin-top:10px;">

		<form method="post" action="/register">
			<fieldset>
                <legend>Register New Band</legend><br>
                            <label>First Name <span class="required">*</span></label>
                                        <div class="input-control text" data-role="input-control">
                                            <input required name="first_name" type="text" placeholder="First name" value="" autofocus autocomplete="off">
                                        </div>
                                        <label>Email </label>
                                        <div class="input-control text" data-role="input-control">
                                           <input required name="email" type="email" placeholder="Email Address" value="" autocomplete="off">
                                        </div>
    
                              
					               		 <input type="hidden" name="selfregistered" value="true"> 
                                        <input type="hidden" name="submitType" value="save_confirm"> 
     
                                        <input type="submit" value="Activate Band" class="btn">
                                   

                                    </fieldset> 
                                </form>
	    </div>
	  </div>
	</div>
   


    </div>

</div><div id="footer">&nbsp;</div>


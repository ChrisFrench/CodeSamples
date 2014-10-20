<?php echo \Dsc\System::instance()->renderMessages(); ?>

 <div class="pushdown" style="padding:10px;margin-top:10px;">

		<form method="post" action="/<?php echo $event->event_id; ?>/attendee/register">
			<fieldset>
                <legend>Information</legend><br>
                            <label>First Name <span class="required">*</span></label>
                                        <div class="input-control text" data-role="input-control">
                                            <input required name="first_name" type="text" placeholder="First Name" value="" autofocus>
                                        </div>
                                        <label>Email </label>
                                        <div class="input-control text" data-role="input-control">
                                           <input required name="email" type="email" placeholder="Email" value="">
                                        </div>
        <br/><br/>
                                        </div>
                                         <legend></legend> 
                                        <input type="hidden" name="submitType" value="save_confirm">      
                                        <input type="submit" value="Activate New Band" class="btn">
                                   

                                    </fieldset>
                                </form>
	    </div>
	  </div>
	</div>
   


    </div>

</div>
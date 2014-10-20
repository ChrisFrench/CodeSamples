<?php //echo \Dsc\Debug::dump( $flash->get('old'), false ); ?>

<div class="row">
 <div class="col-lg-6">
   <div class="widget">
    <div class="widget-header"> <i class="icon-plus-sign"></i><h3>Create Event</h3></div>
    <div class="widget-content">
  
       <form id="detail-form" action="" class="form" method="post">
		<div class="row">
                  <div class="col-md-3">
                    <label for="normal-field" class="control-label">Event Name</label>
                    </div>
                    <div class="col-md-9">
                    <div class="form-group">
			 <input type="text" name="name" placeholder="Event Name" value="<?php echo $flash->old('name'); ?>" class="form-control" id="event-name"> 
                    </div>
                    </div>
        </div>
		<div class="row">
                 <div class="col-md-3">
                    <label for="normal-field" class="control-label">Event ID</label>
                 </div>
                    <div class="col-md-9">
                    <div class="form-group">
			 <input type="text" name="event_id" placeholder="Event ID" value="<?php echo $flash->old('event_id'); ?>"  class="form-control" id="event-id"> 
                    </div>
                    </div>
        </div>
        <div class="row">
                 <div class="col-md-3">
                    <label for="normal-field" class="control-label">Event TimeZone</label>
                 </div>
                    <div class="col-md-9">
                    <div class="form-group">
       <input type="text" name="event_time_zone" placeholder="America/Montreal" value="<?php echo $flash->old('event_time_zone'); ?>"  class="form-control" id="event-time-zone"> 
                    </div>
                    </div>
        </div>  
      <div class="row">
                 <div class="col-md-3">
                    <label for="normal-field" class="control-label">Theme</label>
                 </div>
                    <div class="col-md-9">
                      <div class="form-group">
                      <select name="theme">
                        <option value="">Default</option>
                         <?php 
                        $array = Dsc\Filesystem\Folder::folders( \Base::instance()->get('PATH_ROOT').'apps/Themes' );
                      
                     echo Dsc\Html\Select::options($array, $flash->old('theme'));
                     
                      ?>
                      </select>
                      
                      </div>
                    </div>
        </div>    

		<div class="row">

                  <div class="col-md-3">
                    <label for="normal-field" class="control-label">Dates</label>
                  </div>

                  <div class="col-md-4">
		     <div class="input-group"> <span class="input-group-addon"><i class="icon-calendar"></i></span>
                    <input type="text" name="dates[start_date]" placeholder="Start Date" value="<?php echo $flash->old('dates.start_date' ); ?>" size="16" class="form-control datepicker" id="dates[start_date]" data-inputmask="'alias': 'date'">
                   </div>
                  </div>
                 <div class="col-md-4">
		     <div class="input-group"> <span class="input-group-addon"><i class="icon-calendar"></i></span>
                    <input type="text" name="dates[end_date]" placeholder="End Date" value="<?php echo $flash->old('dates.end_date' ); ?>" size="16" class="form-control datepicker" id="dates[end_date]" data-inputmask="'alias': 'date'">
                   </div>
                  </div>
	</div>
	<div class="control-group">
	
		<div class="row">
                  <div class="col-md-3"><br/>
                    <label for="normal-field" class="control-label">Category</label>
                  </div>

                  <div class="col-md-8">
				<br/>
				<?php $categories =  array('NSO'=> 'New Store Opening', 'XBOX'=> 'Xbox Event', 'HR'=> 'Human Resources', ); ?>
				<select name="category" class="form-control">
				  <?php foreach ($categories as $value => $text) : ?>
				  <option value="<?=$value?>" <?php if($value == $flash->old('category')){ echo 'selected="selected"';} ;?> > <?=$text?>
				  <?php endforeach; ?>
				</select>
		     
                  </div>
		</div>
		<div class="row">
                  <div class="col-md-3"><br/>
                    <label for="normal-field" class="control-label">Address</label>
                  </div>
                  <div class="col-md-3"><br/>
                    <input type="text" class="form-control" name="address[street]" placeholder="Street" value="<?php echo $flash->old('address.street') ?>" >
                  </div>
                  <div class="col-md-3"><br/>
                    <input type="text" class="form-control"  name="address[city]" placeholder="City" value="<?php echo $flash->old('address.city'); ?>" >
                  </div>
                  <div class="col-sm-2"><br/>
                    <input type="text" class="form-control"  name="address[state]" placeholder="State" value="<?php echo $flash->old('address.state'); ?>" >
                  </div>
		</div>
		<div class="row">
                  <div class="col-md-3"><br/>
                    <label for="normal-field" class="control-label"></label>
                  </div>	
                  <div class="col-sm-2"><br/>
                    <input type="text" class="form-control" name="address[zip]" placeholder="Zip" value="<?php echo $flash->old('address.zip'); ?>" >
                  </div>	
                  <div class="col-sm-2"><br/>
                    <input type="text" class="form-control"  name="address[country]" placeholder="Country" value="<?php echo $flash->old('address.country'); ?>" >
                  </div>
		</div>
		<div class="row">
		    <div class="col-md-3"><br/>
                    <label for="normal-field" class="control-label">Wristbands</label>
                  </div>
                  <div class="col-md-3"><br/>
                    <input type="number" class="form-control" name="wristbands[ordered]" placeholder="wristbands" value="<?php echo $flash->old('wristbands.ordered'); ?>" >
                  </div>
		</div>
		<div class="row">
		    <div class="col-md-3"><br/>
                    <label for="normal-field" class="control-label">Attendees</label>
                  </div>
                  <div class="col-md-3"><br/>
                    <input type="number" class="form-control" name="attendees" placeholder="Attendee Limit" value="<?php echo $flash->old('attendees'); ?>" >
                  </div>
		</div>
	           
                    <div><br/>
   			  <input id="primarySubmit" type="hidden" value="save_edit" name="submitType" />
          <a class="btn btn-success" onclick="document.getElementById('primarySubmit').value='save_close'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Create Event</a>
                                 </div>
             






		</div>

   
	</form>
   
	<script type="text/javascript">
		$('#event-name').on('input', function(e) {
		
	
		var str = $('#event-name').val();
		var newstr = str.replace(/\s/g, '-');
		$('#event-id').val(newstr);
   


	});

	</script>

   </div>
 </div>
</div>



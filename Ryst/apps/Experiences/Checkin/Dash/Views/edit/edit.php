<form id="detail-form" action="" class="form-horizontal" method="post">

<div class="form-actions clearfix">
    <div class="row">
            <div class="form-group">
		  <label class="col-md-3">Name</label>
		 <div class="col-md-3">
                <input type="text" name="name" placeholder="Experirence Name" value="<?php echo $flash->old('name'); ?>" class="form-control" />
               </div>
            </div>

            <div class="form-group">
		  <label class="col-md-3">Device Serial</label>
		 <div class="col-md-3">
                <input type="text" name="device_id" placeholder="" value="<?php echo $flash->old('device_id'); ?>" class="form-control" />
               </div>
            </div>

            <div class="form-group">
		  <label class="col-md-3">Type</label>
		 <div class="col-md-3">
                <input type="text" name="type" placeholder="type" value="<?php echo $flash->old('type'); ?>" class="form-control" />
               </div>
            </div>
  

            <div class="form-group">
		      <label class="col-md-3">Controller</label>
		       <div class="col-md-3">
                <input type="text" name="controller" placeholder="controller" value="<?php echo $flash->old('controller'); ?>" class="form-control" />
               </div>
            </div>
   
       

            <div class="form-group">
		  <label class="col-md-3">Action</label>
		 <div class="col-md-3">
                <input type="text" name="action" placeholder="action" value="<?php echo $flash->old('action'); ?>" class="form-control" />
               </div>
            </div>
 

    </div>
<h1>Sessions</h1>
<?php //TODO behind schedule instead of session[0]  session[1], lets build a dynamic thing ?>
  <div class="row">
         <fieldset><legend>Session 1</legend>
            <div class="form-group">
		  <label class="col-md-3">Name</label>
			 <div class="col-md-3">
                <input type="text" name="session[0][name]" placeholder="Name" value="<?php echo $flash->old('session.0.name'); ?>" class="form-control" />
               </div>
               <label class="col-md-3">description</label>
             	<div class="col-md-3">
                <input type="text" name="session[0][description]" placeholder="description" value="<?php echo $flash->old('session.0.description'); ?>" class="form-control" />
                </div>
                 <label class="col-md-3">Start Time</label>
                <div class="col-md-3">
                <input type="text" name="session[0][start_time]" placeholder="Start Time" value="<?php echo $flash->old('session.0.start_time'); ?>" class="form-control" />
               </div>
               <label class="col-md-3">End Time</label>
                <div class="col-md-3">
                <input type="text" name="session[0][end_time]" placeholder="Start Time" value="<?php echo $flash->old('session.0.end_time'); ?>" class="form-control" />
               </div>
               </div>
         </fieldset>


            <fieldset><legend>Session 2</legend>
            <div class="form-group">
		  <label class="col-md-3">Name</label>
			 <div class="col-md-3">
                <input type="text" name="session[1][name]" placeholder="Name" value="<?php echo $flash->old('session.1.name'); ?>" class="form-control" />
               </div>
               <label class="col-md-3">description</label>
             	<div class="col-md-3">
                <input type="text" name="session[1][description]" placeholder="description" value="<?php echo $flash->old('session.1.description'); ?>" class="form-control" />
                </div>
                 <label class="col-md-3">Start Time</label>
                <div class="col-md-3">
                <input type="text" name="session[1][start_time]" placeholder="Start Time" value="<?php echo $flash->old('session.1.start_time'); ?>" class="form-control" />
               </div>
               <label class="col-md-3">End Time</label>
                <div class="col-md-3">
                <input type="text" name="session[1][end_time]" placeholder="Start Time" value="<?php echo $flash->old('session.1.end_time'); ?>" class="form-control" />
               </div>
               </div>
         </fieldset>


         
            <fieldset><legend>Session 3</legend>
            <div class="form-group">
		  <label class="col-md-3">Name</label>
			 <div class="col-md-3">
                <input type="text" name="session[2][name]" placeholder="Name" value="<?php echo $flash->old('session.2.name'); ?>" class="form-control" />
               </div>
               <label class="col-md-3">description</label>
             	<div class="col-md-3">
                <input type="text" name="session[2][description]" placeholder="description" value="<?php echo $flash->old('session.2.description'); ?>" class="form-control" />
                </div>
                 <label class="col-md-3">Start Time</label>
                <div class="col-md-3">
                <input type="text" name="session[2][start_time]" placeholder="Start Time" value="<?php echo $flash->old('session.2.start_time'); ?>" class="form-control" />
               </div>
               <label class="col-md-3">End Time</label>
                <div class="col-md-3">
                <input type="text" name="session[2][end_time]" placeholder="Start Time" value="<?php echo $flash->old('session.2.end_time'); ?>" class="form-control" />
               </div>
               </div>
         </fieldset>
            
  </div>

                <div class="pull-right">
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <input id="primarySubmit" type="hidden" value="save_edit" name="submitType" />
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a onclick="document.getElementById('primarySubmit').value='save_close'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Close</a>
                            </li>
                        </ul>
                    </div>

                    &nbsp;
                    <a class="btn btn-default" href="./<?php echo $PARAMS['eventid'] ?>/attendees">Cancel</a>
                </div>

            </div>
            <!-- /.form-actions -->
</div>



</form>
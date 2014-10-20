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
 		
 		
 		<fieldset>
 		<legend>Web Socket</legend>
 		 <div class="form-group">
		  <label class="col-md-3">Public Key</label>
		 <div class="col-md-3">
                <input type="text" name="pusher[public]"  value="<?php echo $flash->old('pusher.public'); ?>" class="form-control" />
               </div>
            </div>
            <div class="form-group">
		  <label class="col-md-3">Private Key</label>
		 <div class="col-md-3">
                <input type="text" name="pusher[private]"  value="<?php echo $flash->old('pusher.public'); ?>" class="form-control" />
               </div>
            </div>
            <div class="form-group">
		  <label class="col-md-3">Public Key</label>
		 <div class="col-md-3">
                <input type="text" name="pusher[private]"  value="<?php echo $flash->old('pusher.public'); ?>" class="form-control" />
               </div>
            </div>
 		</fieldset>

           

            <div class="form-group">
		  <label class="col-md-3">Region</label>
		 <div class="col-md-3">
                <input type="text" name="region" placeholder="Region" value="<?php echo $flash->old('region'); ?>" class="form-control" />
               </div>
            </div>
 

            <div class="form-group">
		  <label class="col-md-3">Tag Id</label>
		 <div class="col-md-3">
                <input type="text" name="tagid" placeholder="Tag Id" value="<?php echo $flash->old('tagid'); ?>" class="form-control" />
               </div>
            </div>
    

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
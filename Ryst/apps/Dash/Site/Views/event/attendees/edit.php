<?php // echo \Dsc\Debug::dump( $flash->get('old'), false ); ?>


<form id="detail-form" action="" class="form-horizontal" method="post">

<div class="form-actions clearfix">
    <div class="row">

            <div class="form-group">
		  <label class="col-md-3">First Name</label>
		 <div class="col-md-3">
                <input type="text" name="first_name" placeholder="First Name" value="<?php echo $flash->old('first_name'); ?>" class="form-control" />
               </div>
            </div>

            <div class="form-group">
		  <label class="col-md-3">Last Name</label>
		 <div class="col-md-3">
                <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $flash->old('last_name'); ?>" class="form-control" />
               </div>
            </div>

            <div class="form-group">
		  <label class="col-md-3">Email</label>
		 <div class="col-md-3">
                <input type="text" name="email" placeholder="Email" value="<?php echo $flash->old('email'); ?>" class="form-control" />
               </div>
            </div>
  

            <div class="form-group">
		  <label class="col-md-3">Phone</label>
		 <div class="col-md-3">
                <input type="text" name="phone" placeholder="Phone" value="<?php echo $flash->old('phone'); ?>" class="form-control" />
               </div>
            </div>
   
       

            <div class="form-group">
		  <label class="col-md-3">Gender</label>
		 <div class="col-md-3">
                <input type="text" name="gender" placeholder="Gender" value="<?php echo $flash->old('gender'); ?>" class="form-control" />
               </div>
            </div>
 

            <div class="form-group">
		  <label class="col-md-3">Age</label>
		 <div class="col-md-3">
                <input type="text" name="age" placeholder="Age" value="<?php echo $flash->old('age'); ?>" class="form-control" />
               </div>
            </div>

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
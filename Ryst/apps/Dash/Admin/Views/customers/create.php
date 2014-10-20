<div class="well">

<form id="detail-form"  class="form-horizontal" method="post">

    <div class="row">
        <div class="col-md-12">
        
            <div class="clearfix">

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
                    <a class="btn btn-default" href="./admin/customers">Cancel</a>
                </div>

            </div>
            <!-- /.form-actions -->
            
            <hr />
        
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-basics" data-toggle="tab"> Company Information </a>
                </li>

                <?php foreach ((array) $this->event->getArgument('tabs') as $key => $title ) { ?>
                <li>
                    <a href="#tab-<?php echo $key; ?>" data-toggle="tab"> <?php echo $title; ?> </a>
                </li>
                <?php } ?>
            </ul>
            
            <div class="tab-content">

                <div class="tab-pane active" id="tab-basics">
                
                    <div class="form-group">
                        <label class="col-md-3">Company Name</label>
        
                        <div class="col-md-7">
                            <input type="text" name="name" value="<?php echo $flash->old('name'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>
                    <!-- /.form-group -->
                    <fieldset>
                        <legend>Address</legend>
                  
                    <div class="form-group">
        
                        <label class="col-md-3">Address 1</label>
        
                        <div class="col-md-7">
                            <input type="text" name="address[address1]" value="<?php echo $flash->old('address.address1'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>
                     <div class="form-group">
        
                        <label class="col-md-3">Address 2</label>
        
                        <div class="col-md-7">
                            <input type="text" name="address[address2]" value="<?php echo $flash->old('address.address2'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>
                    <!-- /.form-group -->
            
                    <div class="form-group">
        
                        <label class="col-md-3">City</label>
        
                        <div class="col-md-7">
                            <input type="text" name="address[city]" value="<?php echo $flash->old('address.city'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>
                    <!-- /.form-group -->
        
                    <div class="form-group">
        
                        <label class="col-md-3">State</label>
        
                        <div class="col-md-7">
                            <input type="text" name="address[state]" value="<?php echo $flash->old('address.state'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>

                    <div class="form-group">
        
                        <label class="col-md-3">Country</label>
        
                        <div class="col-md-7">
                            <input type="text" name="address[country]" value="<?php echo $flash->old('address.country'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>
                     </fieldset>
                    <!-- /.form-group -->   
                    <div class="form-group">
        
                        <label class="col-md-3">Sub Domain</label>
        
                        <div class="col-md-7">
                            <input type="text" name="subdomain" value="<?php echo $flash->old('subdomain'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>             
                </div>
                <!-- /.tab-pane -->
                
               
        </div>
    </div>

</form>

</div>
<div class="well">

<form id="detail-form" class="form-horizontal" method="post">

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
                    <a class="btn btn-default" href="./admin/proposals">Cancel</a>
                </div>

            </div>
            <!-- /.form-actions -->
            
            <hr />
        
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-basics" data-toggle="tab"> Client </a>
                </li>
                <li>
                    <a href="#tab-salesrep" data-toggle="tab"> Sales Rep </a>
                </li>
                <li>
                    <a href="#tab-event" data-toggle="tab"> Project Overview </a>
                </li>
                <li>
                    <a href="#tab-rystbands" data-toggle="tab"> Rystbands </a>
                </li>
                <li>
                    <a href="#tab-smartstations" data-toggle="tab"> Smart Stations </a>
                </li>
                <li>
                    <a href="#tab-coverletter" data-toggle="tab"> Cover Letter </a>
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
                        <label class="col-md-3">Client First Name</label>
        
                        <div class="col-md-7">
                            <input type="text" name="client[first_name]" value="<?php echo $flash->old('client.first_name'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>
                    <!-- /.form-group -->
        
                     <div class="form-group">
                        <label class="col-md-3">Client Last Name</label>
        
                        <div class="col-md-7">
                            <input type="text" name="client[last_name]" value="<?php echo $flash->old('client.last_name'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                     </div>
                     <div class="form-group">
                        <label class="col-md-3">Client Title</label>
        
                        <div class="col-md-7">
                            <input type="text" name="client[title]" value="<?php echo $flash->old('client.title'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                     </div>
                    <!-- /.form-group -->
        
                    
                     <div class="form-group">
                        <label class="col-md-3">Client Email</label>
        
                        <div class="col-md-7">
                            <input type="text" name="client[email]" value="<?php echo $flash->old('client.email'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                     </div>
                     <div class="form-group">
                        <label class="col-md-3">Client Company</label>
        
                        <div class="col-md-7">
                            <input type="text" name="client[company]" value="<?php echo $flash->old('client.company'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                     </div>
                    <div class="form-group">
                        <label class="col-md-3">Client Phone</label>
        
                        <div class="col-md-7">
                            <input type="text" name="client[phone]" value="<?php echo $flash->old('client.phone'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                     </div>
        
                    
                    <!-- /.form-group -->   
                                 
                </div>
                <!-- /.tab-pane -->
                
                <div class="tab-pane" id="tab-salesrep">
                    
                     <div class="form-group">
                        <label class="col-md-3">Sales First Name</label>
        
                        <div class="col-md-7">
                            <input type="text" name="sales[first_name]" value="<?php echo $flash->old('sales.first_name'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
        
                    </div>

                     <div class="form-group">
                        <label class="col-md-3">Sales Last Name</label>
        
                        <div class="col-md-7">
                            <input type="text" name="sales[last_name]" value="<?php echo $flash->old('sales.last_name'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>

                     <div class="form-group">
                        <label class="col-md-3">Sales Title</label>
        
                        <div class="col-md-7">
                            <input type="text" name="sales[title]" value="<?php echo $flash->old('sales.title'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>

                     <div class="form-group">
                        <label class="col-md-3">Sales Phone</label>
        
                        <div class="col-md-7">
                            <input type="text" name="sales[phone]" value="<?php echo $flash->old('sales.phone'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>

                     <div class="form-group">
                        <label class="col-md-3">Sales Email</label>
        
                        <div class="col-md-7">
                            <input type="text" name="sales[email]" value="<?php echo $flash->old('sales.email'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>
                
                </div>

                  <div class="tab-pane" id="tab-event">
                     <div class="form-group">
                        <label class="col-md-3">Event Name</label>
        
                        <div class="col-md-7">
                            <input type="text" name="event[name]" value="<?php echo $flash->old('event.name'); ?>" class="form-control" />
                        </div>
	
                        <!-- /.col -->
                    </div>
                    <div class="form-group">
                        <label class="col-md-3">Event Length (Days)</label>
        
                        <div class="col-md-7">
                            <input type="text" name="event[days]" value="<?php echo $flash->old('event.days'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>   
                    
                     <div class="form-group">
                        <label class="col-md-3">Project Overview</label>
        
                        <div class="col-md-7">
                            <textarea rows="20" class="form-control" name="projectoverview[desc]" ><?php echo $flash->old('projectoverview.desc'); ?></textarea>
                        </div>
	
                        <!-- /.col -->
                    </div>                

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab-rystbands">
                    
                    <div class="form-group">
                        <label class="col-md-3">Number of Rystbands</label>
        
                        <div class="col-md-7">
                            <input type="text" name="rystbands[qty]" value="<?php echo $flash->old('rystbands.qty'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="form-group">
                        <label class="col-md-3">Customization of Rystbands</label>
        
                        <div class="col-md-7">
                        <select name="rystbands[custom]" class="form-control">
                        <?php echo \Dsc\Html\Select::options(array('no', 'yes'), $flash->old('rystbands.custom')); ?>
            </select>
                        </div>
                        <!-- /.col -->
                    </div> 
                     <div class="form-group">
                        <label class="col-md-3">Customization Price</label>
        
                        <div class="col-md-7">
                            <input type="text" name="rystbands[custom_price]" value="<?php echo $flash->old('rystbands.custom_price'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>
                
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab-smartstations">
                    
                   <div class="form-group">
                        <label class="col-md-3">Number of Smart Stations</label>
        
                        <div class="col-md-7">
                            <input type="text" name="smartstations[qty]" value="<?php echo $flash->old('smartstations.qty'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="form-group">
                        <label class="col-md-3">Smart Station Price / Event Day</label>
        
                        <div class="col-md-7">
                            <input type="text" name="smartstations[price]" value="<?php echo $flash->old('smartstations.price'); ?>" class="form-control" />
                        </div>
                        <!-- /.col -->
                    </div>

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab-coverletter">
                    
                  <div class="form-group">
                        <label class="col-md-3">Introduction</label>
        
                        <div class="col-md-7">
                            <textarea  name="coverletter[intro]" ><?php echo $flash->old('coverletter.intro'); ?></textarea>
                        </div>
                        <!-- /.col -->
                    </div>
                
                </div>
                <!-- /.tab-pane -->
                
                <?php foreach ((array) $this->event->getArgument('content') as $key => $content ) { ?>
                <div class="tab-pane" id="tab-<?php echo $key; ?>">
                    <?php echo $content; ?>
                </div>
                <?php } ?>
                
            </div>
            <!-- /.tab-content -->
        </div>
    </div>

</form>

</div>
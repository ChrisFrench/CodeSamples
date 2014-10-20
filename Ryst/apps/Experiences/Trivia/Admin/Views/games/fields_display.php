<div class="row">
    <div class="col-md-2">
        
        <h3>Display</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="portlet">

            <div class="portlet-header">

                <h3>View File</h3>
                <p class="help-block">Which file should be used to display this page?</p>

            </div>
            <!-- /.portlet-header -->

            <div class="portlet-content">
            
                <div class="input-group">
                    <select name="display[view]" class="form-control">
                        <option value="" <?php if (!$flash->old('display.view')) { echo "selected"; } ?>>-- Default --</option>
                        <?php $variants = \Dsc\System::instance()->get('theme')->variants( 'Pages/Site/Views::pages/view.php' ); ?>
                        <?php foreach ($variants as $group=>$views) { ?>
                            <optgroup label="<?php echo $group; ?>">
                                <?php foreach ($views as $view) { ?>
                                <option value="<?php echo $view; ?>" <?php if ($flash->old('display.view') == $view) { echo "selected"; } ?>><?php echo $view; ?></option>
                                <?php } ?>
                            </optgroup>
                        <?php } ?>
                    </select> 
                </div>
                <!-- /.form-group -->

            </div>
            <!-- /.portlet-content -->

        </div>
        <!-- /.portlet -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->

<?php // echo \Dsc\Debug::dump( $flash->get('old'), false ); ?>


<form id="detail-form" action="" class="form-horizontal" method="post">

<div class="form-actions clearfix">
    <div class="row">

            <div class="form-group">
          <label class="col-md-3">Tagid</label>
         <div class="col-md-3">
             http://ryst.cc/b/<input type="text" name="tagid" placeholder="Tagid" value="<?php echo $flash->old('tagid'); ?>" class="" />
               </div>
            </div>

            <div class="form-group">
          <label class="col-md-3">Type</label>
          <div class="col-md-3">
            <select name="type">

            
            <?php

            $array = array();
            $array[] = array('text' => 'Event', 'value'=>'event', 'data' => array('text' => 'ing'));
            $array[] = array('text' => 'Special', 'value'=>'special', 'data' => array('text' => 'ing'));

             echo \Dsc\Html\Select::options( $array, $flash->old('type') );?>

           </select>
             
               </div>
            </div>
            <?php /*
            <div class="form-group">
          <label class="col-md-3">Actions</label>
               <div class="col-md-3">
                <input type="text" name="actions[controller]" placeholder="Controller" value="<?php echo $flash->old('actions.controller'); ?>" class="form-control" />
               </div>
            </div>
  
  */?>
         
    

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
                    <a class="btn btn-default" href="./<?php echo $PARAMS['eventid'] ?>/wristbands">Cancel</a>
                </div>

            </div>
            <!-- /.form-actions -->
</div>



</form>
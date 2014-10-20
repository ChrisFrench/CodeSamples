<?php // echo \Dsc\Debug::dump( $flash->get('old'), false ); ?>



<form id="detail-form" action="" class="form" method="post">
<div class="form-actions clearfix">
          <!-- /.form-actions -->
    <div class="row">
         <div class="col-md-9">
            <div class="form-group">
            <label>Prize Name</label>
                <input type="text" name="name" placeholder="Prize name" value="<?php echo $flash->old('name'); ?>" class="form-control" />
                
            </div>
        </div>
         <div class="col-md-9">
            <div class="form-group">
             <label>details</label>
                <input type="text" name="details" placeholder="Details" value="<?php echo $flash->old('details'); ?>" class="form-control" />
                
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
             <label>Win by Time</label>
                <div class="input-group"> <span class="input-group-addon"><i class="icon-calendar"></i></span>
                     <input type="text" name="winbytime" placeholder="Win By" value="<?php echo $flash->old('winbytime' ); ?>" size="16" class="form-control datepicker" id="winbytime" data-inputmask="'alias': 'date'">

                   </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <div class="input-group"> 
                 <label>Prize Type</label>
                     <input type="text" name="type"  value="<?php echo $flash->old('type' ); ?>" size="16" class="form-control " id="type" >
                   </div>
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
  </form>
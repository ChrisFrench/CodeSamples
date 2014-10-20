

<form id="detail-form" action="" class="form" method="post">
 <div class="form-actions clearfix">
    <div class="row">
            <div class="col-md-9">
                <div class="form-group">
              <label>Name</label>
                    <input type="text" name="name" placeholder="Name" value="<?php echo $flash->old('name'); ?>" class="form-control" />
                </div>
                 <div class="form-group">
              <label>Type</label>
                    <input type="text" name="type" placeholder="type" value="<?php echo $flash->old('type'); ?>" class="form-control" />
                </div>
                 <div class="form-group">
              <label>Group</label>
                    <input type="text" name="group" placeholder="group" value="<?php echo $flash->old('group'); ?>" class="form-control" />
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
                    <a class="btn btn-default" href="./<?php echo $PARAMS['eventid'] ?>/users">Cancel</a>
                </div>

            </div>


   
</form>


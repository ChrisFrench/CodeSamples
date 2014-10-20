<script src="./ckeditor/ckeditor.js"></script>
<script>
jQuery(document).ready(function(){
    CKEDITOR.replaceAll( 'wysiwyg' );    
});
</script>

<div class="well">

<form id="detail-form" class="form" method="post">

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
                        <a onclick="document.getElementById('primarySubmit').value='save_new'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Create Another</a>
                    </li>
                    <li>
                        <a onclick="document.getElementById('primarySubmit').value='save_close'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Close</a>
                    </li>
                </ul>
            </div>                          
            &nbsp;
            <a class="btn btn-default" href="./admin/trivia/games">Cancel</a>
        </div>

    </div>
    
    <hr />
    <!-- /.form-actions -->
    
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab-basics" data-toggle="tab"> Basics </a>
        </li>
        <li>
            <a href="#tab-users" data-toggle="tab"> Users </a>
        </li>
        
        <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('tabs') as $key => $title ) { ?>
        <li>
            <a href="#tab-<?php echo $key; ?>" data-toggle="tab"> <?php echo $title; ?> </a>
        </li>
        <?php } } ?>                
    </ul>
    
    <div class="tab-content padding-10">
    
        <div class="tab-pane active" id="tab-basics">
        	<div class="row">
    <div class="col-md-2">
    
        <h3>Details</h3>
        <p class="help-block">Some helpful text</p>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" placeholder="Title" value="<?php echo $flash->old('title'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
		            <input type="hidden" name="slug" value="<?php echo $flash->old('slug'); ?>" class="form-control" />
		
     
        <div class="form-group">
            <textarea name="copy" class="form-control wysiwyg"><?php echo $flash->old('copy'); ?></textarea>
        </div>
        <!-- /.form-group -->
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->

<hr />
<h3>Question Categories</h3>
<?php echo $this->renderLayout('Experiences/Trivia/Admin/Views::categories/checkboxes.php'); ?>

<hr />

<div class="form-group">
    <label>Group of Users allowed to play this game</label>
<?php echo $this->renderView('Users/Admin/Views::users/fields_groups.php'); ?>
                          
</div>

<h1>Start Time</h1>

<?php echo $this->renderLayout('Experiences/Trivia/Admin/Views::games/fields_basics_publication.php'); ?>

<!-- /.form-group -->             	
            
        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="tab-users">
        	<div class="row">
        	<?php 
        		if( empty( $flash->old( '_id' ) ) ) { ?>
        		No users played this game so far.
			<?php } else { 
					$users = $item->getUsers();
					
					if( count( $users ) ){ ?>
						<table class="table table-stripped">
						<thead>
							<tr>
								<th>User Name</th>
							</tr>
						</thead>
						<?php
						foreach( $users as $user ){ ?>
						<tr>
							<td>
								<?php echo $user->fullName(); ?>
			                        <a class="btn btn-xs btn-danger" data-bootbox="confirm" target="_blank" href="./admin/trivia/game/<?php echo $item->id; ?>/deleteuser/<?php echo $user->id; ?>">
			                            <i class="fa fa-times"></i>
			                        </a>
							</td>
						</tr>
						
					<?php
						}
						?>
						</table>
					<?php } else { ?>
		        		No users played this game so far.					
					<?php }
			 	}
        	?>
        	</div>
            
        </div>
        <!-- /.tab-pane -->
        
        
        <!-- /.tab-pane -->
        
        <?php if (!empty($this->event)) { foreach ((array) $this->event->getArgument('content') as $key => $content ) { ?>
        <div class="tab-pane" id="tab-<?php echo $key; ?>">
            <?php echo $content; ?>
        </div>
        <?php } } ?>
        <!-- /.tab-pane -->
    
    </div>
</form>

</div>
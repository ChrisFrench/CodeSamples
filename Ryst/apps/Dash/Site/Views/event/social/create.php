<?php // echo \Dsc\Debug::dump( $flash->get('old'), false ); ?>

<script src="./ckeditor/ckeditor.js"></script>
<script>
jQuery(document).ready(function(){
    CKEDITOR.replaceAll( 'wysiwyg' );    
});

</script>

<form id="detail-form"  class="form" method="post">
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <input type="text" required name="title" placeholder="Title" value="<?php echo $flash->old('title'); ?>" class="form-control" />
            </div>
            <!-- /.form-group -->
            
             <div class="form-group">
             <select name="source">
                 <option>Facebook</option>
                 <option>Twitter</option>
                 <option>Youtube</option>
             </select>
            </div>
            <!-- /.form-group -->
             <div class="form-group">
                <input type="text" name="message" placeholder="Messge" value="<?php echo $flash->old('meassge'); ?>" class="form-control" />
            </div>
            <!-- /.form-group -->
             <div class="form-group">
                <input type="text" name="avatar" placeholder="Avatar" value="<?php echo $flash->old('avatar'); ?>" class="form-control" />
            </div>
            <!-- /.form-group -->
             <div class="form-group">
                <input type="text" name="img" placeholder="Image" value="<?php echo $flash->old('img'); ?>" class="form-control" />
            </div>
            <!-- /.form-group -->
             <div class="form-group">
                <input type="text" name="icon" placeholder="icon" value="<?php echo $flash->old('icon'); ?>" class="form-control" />
            </div>
            <!-- /.form-group -->
             <div class="form-group">
                <input type="text" name="published" placeholder="published" value="<?php echo $flash->old('published'); ?>" class="form-control" />
            </div>
            <!-- /.form-group -->
            <input  type="submit" value="Submit">
        </div>
    
    </div>
</form>
<div class="row">
    <div class="col-md-2">
    
        <h3>Categories</h3>
        <p class="help-block">Some helpful text</p>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div id="categories" class="list-group">
            <div id="categories-checkboxes">
            <?php echo $this->renderLayout('Pages/Admin/Views::categories/checkboxes.php'); ?>
            </div>
    
            <div class="list-group-item">
                <script>
                Dsc.refreshCategories = function(r) {
    
                    var form_data = new Array();
                	jQuery.merge( form_data, jQuery('#categories-checkboxes').find(':input').serializeArray() );
                	jQuery.merge( form_data, [{ name: "category_ids[]", value: r.result._id['$id'] }] );
    
                    var request = jQuery.ajax({
                        type: 'post', 
                        url: './admin/pages/categories/checkboxes',
                        data: form_data
                    }).done(function(data){
                        var lr = jQuery.parseJSON( JSON.stringify(data), false);
                        if (lr.result) {
                            jQuery('#categories-checkboxes').html(lr.result);
                            CustomApp.initICheck();
                        }
                    });
                }
                </script>
                                        
                <div data-toggle="collapse" data-target="#addCategoryForm" class="btn btn-link">
                    Add New Category
                </div>
                <div id="addCategoryForm" class="collapse">
                    <div class="panel-body">
                        
                        <div id="quick-form" action="./admin/pages/category/create" data-callback="Dsc.refreshCategories" data-message_container="quick-form-response-container">
                        
                        <div id="quick-form-response-container"></div>
                        
                        <div class="form-group">
                            <input type="text" name="new_category_title" placeholder="Title" class="form-control" />
                        </div>
                        <!-- /.form-group -->
                        
                        <div id="parents" class="form-group">
                            <?php echo $this->renderLayout('Pages\Admin\Views::categories/list_parents.php'); ?>                    
                        </div>
                        <!-- /.form-group -->        
        
                        <hr />
        
                        <div class="form-actions">
        
                            <div>
                                <button type="button" class="btn btn-primary dsc-ajax-submit" data-target="quick-form">Create</button>
                            </div>
        
                        </div>
                        <!-- /.form-group -->
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /.form-group -->
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> Assets<span> > List </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="list-actions list-unstyled list-inline">
            <li>
                <a class="btn btn-default" href="./admin/asset/create">Add New</a>
            </li>
        </ul>
    </div>
</div>

<form class="searchForm" method="post" action="./admin/assets">

    <div class="no-padding">
    
        <div class="row">
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            
                <ul class="list-filters list-unstyled list-inline">
                    <li>
                        <select name="filter[type]" class="form-control" onchange="this.form.submit();">
                            <option value="">All Types</option>
                            <?php foreach (\Dsc\Mongo\Collections\Assets::distinctTypes() as $type) { ?>
                            	<option value="<?php echo $type; ?>" <?php if ($state->get('filter.type') == $type) { echo "selected='selected'"; } ?>><?php echo $type; ?></option>
                            <?php } ?>                            
                        </select>
                    </li>
                    <li>
                        <select name="filter[storage]" class="form-control" onchange="this.form.submit();">
                            <option value="">All Stores</option>
                            <?php foreach (\Dsc\Mongo\Collections\Assets::distinctStores() as $store) { ?>
                            	<option value="<?php echo $store; ?>" <?php if ($state->get('filter.storage') == $store) { echo "selected='selected'"; } ?>><?php echo $store; ?></option>
                            <?php } ?>                            
                        </select>
                    </li>                    
                </ul>    
                
            </div>
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <div class="form-group">
                    <div class="input-group">
                        <input class="form-control" type="text" name="filter[keyword]" placeholder="Search..." maxlength="200" value="<?php echo $state->get('filter.keyword'); ?>"> <span class="input-group-btn"> <input class="btn btn-primary" type="submit"
                            onclick="this.form.submit();" value="Search"
                        />
                            <button class="btn btn-danger" type="button" onclick="Dsc.resetFormFilters(this.form);">Reset</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="widget-body-toolbar">

            <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3">
                    <span class="pagination">
                        <div class="input-group">
                            <select id="bulk-actions" name="bulk_action" class="form-control">
                                <option value="null">-Bulk Actions-</option>
                                <option value="delete" data-action="./admin/assets/delete">Delete</option>
                                <option value="moveToS3" data-action="./admin/assets/moveToS3">Move To S3</option>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-default bulk-actions" type="button" data-target="bulk-actions">Apply</button>
                            </span>
                        </div>
                    </span>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <div class="row text-align-right">
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                            <?php if (!empty($paginated->total_pages) && $paginated->total_pages > 1) { ?>
                                <?php echo $paginated->serve(); ?>
                            <?php } ?>
                        </div>
                        <?php if (!empty($paginated->items)) { ?>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <span class="pagination">
                            <?php echo $paginated->getLimitBox( $state->get('list.limit') ); ?>
                            </span>
                        </div>
                        <?php } ?>
                    </div>            
                </div>
            </div>

        </div>
        <!-- /.widget-body-toolbar -->
        
        <input type="hidden" name="list[order]" value="<?php echo $state->get('list.order'); ?>" />
        <input type="hidden" name="list[direction]" value="<?php echo $state->get('list.direction'); ?>" />
        
        
        <div class="table-responsive datatable dt-wrapper dataTables_wrapper">
        
            <table class="table table-striped table-bordered table-hover table-highlight table-checkable">
            	<thead>
            		<tr>
            		    <th class="checkbox-column"><input type="checkbox" class="icheck-input"></th>
            		    <th class="col-md-1"></th>
            			<th data-sortable="title">Title</th>
            			<th class="col-md-1">Location</th>
            			<th data-sortable="metadata.created.time">Created</th>
            			<th data-sortable="metadata.last_modified.time">Last Modified</th>
            			<th class="col-md-1"></th>
            		</tr>
            	</thead>
            	<tbody>    
            
                <?php if (!empty($paginated->items)) { ?>
    
                <?php foreach($paginated->items as $item) { ?>
                    <tr>
                        <td class="checkbox-column">
                            <input type="checkbox" class="icheck-input" name="ids[]" value="<?php echo $item->slug; ?>">
                        </td>
                        
                        <td class="">
                            <?php if ($item->thumb) { ?>
                                <?php if ($item->isImage()) { ?>
                            	<div class="thumbnail text-center">
                                	<div class="thumbnail-view">
                                		<a class="thumbnail-view-hover ui-lightbox" href="./asset/<?php echo $item->{'slug'}; ?>">
                                		</a>
                                        <img src="http://ryst.cc/asset/thumb/<?php echo $item->slug; ?>" alt="<?php echo $item->{'title'}; ?>" />
            				        </div>
            				    </div> <!-- /.thumbnail -->                
                                <?php } else { ?>
                                    <div class="thumbnail text-center">
                                    <a href="./admin/asset/edit/<?php echo $item->slug; ?>">
                                    <img src="<?php echo \Dsc\Image::dataUri( $item->thumb->bin ); ?>" alt="<?php echo $item->{'title'}; ?>" />
                                    </a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        
                        <td class="">
                            <h5>
                            <a href="./admin/asset/edit/<?php echo $item->slug; ?>">
                            <?php echo $item->{'title'}; ?>
                            </a>
                            </h5>
            
                            <a class="help-block" target="_blank" href="./asset/<?php echo $item->{'slug'}; ?>">
                            /<?php echo $item->{'slug'}; ?>
                            </a>
                            
                            <p class="help-block">
                            MD5: <?php echo $item->{'md5'} ? $item->{'md5'} : '<span class="text-danger"><strong>Invalid</strong></span>'; ?>
                            </p>
                            
                            <?php if ($item->{'tags'}) { ?>
                            <p class="help-block">
                            Tags: <?php echo implode(", ", (array) $item->{'tags'} ); ?>
                            </p>                         
                            <?php } ?>   
            
                        </td>
                        
                        <td class="">
                        <?php echo $item->{'storage'}; ?>
                        </td>
                        
                        <td class="">
                        <?php echo $item->{'metadata.creator.name'}; ?><br/>
                        <?php echo $item->{'metadata.created.time'} ? date( 'Y-m-d h:ia', $item->{'metadata.created.time'} ) : null; ?>
                        </td>
                        
                        <td class="">
                        <?php echo $item->{'metadata.last_modified.time'} ? date( 'Y-m-d h:ia', $item->{'metadata.last_modified.time'} ) : null; ?>
                        </td>
                            
                        <td class="text-center">
                            <a class="btn btn-xs btn-secondary" href="./admin/asset/edit/<?php echo $item->slug; ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                            &nbsp;
                            <a class="btn btn-xs btn-danger" data-bootbox="confirm" href="./admin/asset/delete/<?php echo $item->slug; ?>">
                                <i class="fa fa-times"></i>
                            </a>
                            <a class="btn btn-xs btn-success" href="./admin/asset/rethumb/<?php echo $item->slug; ?>">
                                <i class="fa fa-magic"></i>
                            </a>                
                        </td>
                    </tr>
                <?php } ?>
                
                <?php } else { ?>
                    <tr>
                    <td colspan="100">
                        <div class="">No items found.</div>
                    </td>
                    </tr>
                <?php } ?>
            
                </tbody>
            </table>
        
        </div>
        
	 <div class="dt-row dt-bottom-row">
		<div class="row">
			<div class="col-sm-10">
		    	<?php if (!empty($paginated->total_pages) && $paginated->total_pages > 1) { ?>
		        	<?php echo $paginated->serve(); ?>
		        <?php } ?>
	      	</div>
	     	<div class="col-sm-2">
	       		<div class="datatable-results-count pull-right">
	           		<span class="pagination">
	                	<?php echo (!empty($paginated->total_pages)) ? $paginated->getResultsCounter() : null; ?>
	            	</span>
	        	</div>
	    	</div>        
		</div>
	</div>
        
    </div>
</form>
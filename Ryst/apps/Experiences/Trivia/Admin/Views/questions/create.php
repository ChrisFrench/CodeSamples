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
            <a class="btn btn-default" href="./admin/trivia/questions">Cancel</a>
        </div>

    </div>
    
    <hr />
    <!-- /.form-actions -->
    
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab-basics" data-toggle="tab"> Basics </a>
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
    
        <h3>Question</h3>
        <p class="help-block">Keep questions short and easy to read and understand quickly</p>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <label>Question</label>
            <input type="text" name="question" placeholder="Question" value="<?php echo $flash->old('question'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
        
		<div class="portlet-content">
		<label>Question - Image</label>
        <p class="help-block">An image that is related to the question.</p>
            <?php echo \Assets\Admin\Controllers\Assets::instance()->fetchElementImage('question_image', $flash->old('question_image.slug'), array('field'=>'question_image[slug]') ); ?>
        </div><br>
        <div class="form-group">
            <label>Difficulty</label>
            <select name="difficulty">
            <?php echo \Dsc\Html\Select::options(array('Easy','Moderate', 'Difficult' ), $flash->old('difficulty'));?>
            </select>
        </div>
        
        
        <!-- /.form-group -->
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->

<hr />
<div class="row">
    <div class="col-md-2">
    
        <h3>Answers</h3>
        <p class="help-block">Short, simple, easy to read. <br> <br> The Value is the number of points awarded for picking this answer, most games will be 0, or 5. But you could give partial points (e.g 2 points for a half correct answer)</p>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
		
        <div class="form-group">
            <label>Answer - A</label>
            <input type="text" name="answers[a][text]" value="<?php echo $flash->old('answers.a.text'); ?>" class="form-control" />
            Answer - A - Value :
            
             <select name="answers[a][value]">
             <?php echo \Dsc\Html\Select::options(range(0,10),$flash->old('answers.a.value'));?>
             </select>
        </div>
        <div class="form-group">
            <label>Answer - B</label>
            <input type="text" name="answers[b][text]" value="<?php echo $flash->old('answers.b.text'); ?>" class="form-control" />
            Answer - B - Value :
            
             <select name="answers[b][value]">
             <?php echo \Dsc\Html\Select::options(range(0,10),$flash->old('answers.b.value'));?>
             </select>
        </div>
        <div class="form-group">
            <label>Answer - C</label>
            <input type="text" name="answers[c][text]" value="<?php echo $flash->old('answers.c.text'); ?>" class="form-control" />
            Answer - C - Value :
            
             <select name="answers[c][value]">
             <?php echo \Dsc\Html\Select::options(range(0,10),$flash->old('answers.c.value'));?>
             </select>
        </div>
        <div class="form-group">
            <label>Answer - D</label>
            <input type="text" name="answers[d][text]" value="<?php echo $flash->old('answers.d.text'); ?>" class="form-control" />
            Answer - d - Value :
            
             <select name="answers[d][value]">
             <?php echo \Dsc\Html\Select::options(range(0,10),$flash->old('answers.d.value'));?>
             </select>
          
        </div>
        <!-- /.form-group -->
        
        
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->

<hr />

<?php  echo $this->renderLayout('Experiences/Trivia/Admin/Views::questions/fields_basics_categories.php'); ?>

<hr />

<?php echo $this->renderLayout('Experiences/Trivia/Admin/Views::quesions/fields_basics_tags.php'); ?>
          
          
          
          
          
        </div>
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
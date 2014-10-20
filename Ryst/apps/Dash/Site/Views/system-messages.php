<?php
// \Dsc\System::instance()->addMessage('this is a warning', 'warning');
//\Dsc\System::instance()->addMessage('this is a default', 'message');

 $messages = \Dsc\System::instance()->getMessages(); ?>
<?php if($messages) : ?>
                   	<?php foreach ($messages as  $message) : ?>
                   		 <?php
                   		 //BOOTSTRAP CLASS SWITCHING
                   		  switch ($message['type']) {
	                    	case 'error':
	                    		$class = 'danger';
	                    		break;
	                    	case 'warning':
	                    	case 'notice':
	                    		$class = 'warning';
	                    		break;
	                    	
	                    	default:
	                    		$class = 'success';
	                    		break;
	                    } ?>

	                   	<div class="alert alert-<?php echo $class; ?> alert-block fade in">
	                    <button type="button" class="close close-sm" data-dismiss="alert"> <i class="icon-remove"></i> </button>

	                    <h4> 
	                    <?php switch ($message['type']) {
	                    	case 'error':
	                    		echo '<i class="icon-warning-sign"></i> Error! ';
	                    		break;
	                    	case 'warning':
	                    	case 'notice':
	                    		echo '<i class="icon-warning-sign"></i> Warning! ';
	                    		break;
	                    	
	                    	default:
	                    		echo '<i class="icon-ok-sign"></i> Success! ';
	                    		break;
	                    } ?></h4>

	                    <p><?php echo $message['message']; ?></p>
	                     </div>
                   	<?php endforeach; ?>
<?php endif; ?>

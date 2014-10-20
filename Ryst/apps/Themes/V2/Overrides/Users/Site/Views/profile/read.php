<?php 

$auth = $this->auth->getIdentity();

if($auth->id) :
include 'das_read.php';	
 else : ?>
 
 
 
<?php endif; ?>
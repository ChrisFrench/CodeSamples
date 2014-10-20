<?php 
namespace ZDas\Site\Controllers;

class Offline extends Base
{
   
	public function index() {

		echo $this->theme->render('ZDas/Site/Views::offline/index.php');
	}

}

<?php 

class ControllerOverride extends \Experiences\Spintowin\Site\Controllers\Controller 
{   
  	 	

    protected function gamePlay() {

        $rand = rand(1, 10); 

        switch ( $rand) {
          case  ($rand < "5"):
            $array = array('status' => 'winner', 'prize' => array('name' => 'Prize name', 'prize_id' => 122, 'prize_image' => 'http://placehold.it/350x350?text=Awesome+Prize'));
                break;
            default:
              $array = array('status' => 'loser', 'prize' => array());
                break;
        }	
	return $array;
    }


}
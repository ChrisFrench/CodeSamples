<?php
class RystbandBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Rystband';

    protected function runSite()
    {    

        $f3 = \Base::instance();

        \Dsc\System::instance()->getDispatcher()->addListener(\Rystband\Userlistener::instance());
        \Dsc\System::instance()->getDispatcher()->addListener(\Rystband\Pusherlistener::instance());

        \Dsc\System::instance()->get('router')->mount( new \Rystband\Site\Routes\Bands, $this->namespace );
        \Dsc\System::instance()->get('router')->mount( new \Rystband\Site\Routes\Experiences, $this->namespace );
        \Dsc\System::instance()->get('router')->mount( new \Rystband\Site\Routes\Event, $this->namespace );
		
        \Dsc\System::instance()->get('router')->mount( new \Rystband\Site\Routes\User, $this->namespace );
        \Dsc\System::instance()->get('router')->mount( new \Rystband\Site\Routes\Users, $this->namespace );
        
        //HEADERS ROUTES, these are so JS can call the headers TODO maybe move to this php logic
       // $f3->route('GET /header', '\Rystband\Site\Controllers\Header->base');
       // $f3->route('GET /header-cust', '\Rystband\Site\Controllers\Header->customer');

       // $f3->route('GET /soap', '\Rystband\Site\Controllers\Attendees->soap'); 
        //USERS FRONTEND AUTH ROUTES, creates signup, and login, logout routes
        
       
      
        //$f3->route('GET /login', '\Rystband\Site\Controllers\Auth->showLogin'); 
        //$f3->route('POST /login', '\Rystband\Site\Controllers\Auth->doLogin');
        //$f3->route('GET /signup', '\Rystband\Site\Controllers\Auth->showSignup');
        //$f3->route('POST /signup', '\Rystband\Site\Controllers\Auth->doSignup');
        //$f3->route('GET|POST /logout', '\Users\Rystband\Site\Controllers\User->logout');     
        //$f3->route('GET /roles', '\Rystband\Site\Controllers\Users->roles');
        //$f3->route('GET /active/role/@roleid', '\Rystband\Site\Controllers\Users->role');
        //Tag Parser
      /*  $f3->route('GET /band/@tagid', '\Rystband\Site\Controllers\Tags->action');
        $f3->route('GET /band/@tagid/selfsignup', '\Rystband\Site\Controllers\Selfregister->selfsignin');
        $f3->route('POST /band/@tagid/selfsignup', '\Rystband\Site\Controllers\Selfregister->add');
        $f3->route('GET /band/@id/registerconfirm', '\Rystband\Site\Controllers\Selfregister->registerconfirm');
        $f3->route('GET /band/@tagid/alreadyregistered', '\Rystband\Site\Controllers\Selfregister->alreadyregistered');
        $f3->route('GET /empty', '\Rystband\Site\Controllers\Tags->displayEmpty');

         $f3->route('POST /self/assign/tag/@tagid', '\Rystband\Site\Controllers\Selfregister->assign');
        $f3->route('GET /self/signin/@tagid', '\Rystband\Site\Controllers\Selfregister->signin');
        
        $f3->route('GET|POST /attendee/social', '\Rystband\Site\Controllers\Selfregister->social');
        $f3->route('GET|POST /attendee/social/auth/@provider', '\Rystband\Site\Controllers\Selfregister->provider');

        //Attendee Reg pages
        $f3->route('GET /attendee', '\Rystband\Site\Controllers\Attendees->display');
        $f3->route('POST /attendee/assign/tag/@tagid', '\Rystband\Site\Controllers\Attendee->assign');
        $f3->route('GET /attendee/signin/@tagid', '\Rystband\Site\Controllers\Attendee->signin');
        $f3->route('GET /attendee/create/@tagid', '\Rystband\Site\Controllers\Attendee->create');
        $f3->route('POST /attendee/create/@tagid', '\Rystband\Site\Controllers\Attendee->add');
        $f3->route('GET /attendee/edit/@id', '\Rystband\Site\Controllers\Attendee->edit');
        $f3->route('GET /attendee/customer/@id', '\Rystband\Site\Controllers\Attendee->attendee');
        $f3->route('POST /attendee/customer/update/@id', '\Rystband\Site\Controllers\Attendee->update');
        $f3->route('GET /attendee/confirm/@id', '\Rystband\Site\Controllers\Attendee->confirm');
        // TODO set some app-specific settings, if desired
        //Ticketing pages
        $f3->route('GET /ticketing', '\Rystband\Site\Controllers\Ticketing->display');
        $f3->route('GET /ticketing/create/@id', '\Rystband\Site\Controllers\Ticketing->create');
        $f3->route('POST /ticketing/create/@id', '\Rystband\Site\Controllers\Ticketing->add');
        $f3->route('GET /ticketing/edit/@id', '\Rystband\Site\Controllers\Ticketing->edit');
        $f3->route('GET /ticketing/confirm/@id', '\Rystband\Site\Controllers\Ticketing->confirm');

         //Transfer pages
        $f3->route('GET /transfer', '\Rystband\Site\Controllers\Transfer->home');
        $f3->route('GET /transfer/origin/@id', '\Rystband\Site\Controllers\Transfer->origin');
        $f3->route('GET /transfer/destination/@tagid', '\Rystband\Site\Controllers\Transfer->destination');
        $f3->route('GET /transfer/notempty/@tagid', '\Rystband\Site\Controllers\Transfer->notempty');
        $f3->route('GET /transfer/empty/@tagid', '\Rystband\Site\Controllers\Transfer->isempty');


         //Meet greet Reg pages
        $f3->route('GET /meetgreet', '\Rystband\Site\Controllers\Meetgreets->display');
        $f3->route('GET /meetgreet/create/@tagid', '\Rystband\Site\Controllers\Meetgreet->create');
        $f3->route('POST /meetgreet/create/@tagid', '\Rystband\Site\Controllers\Meetgreet->add');
        $f3->route('GET /meetgreet/edit/@id', '\Rystband\Site\Controllers\Meetgreet->edit');
        $f3->route('GET /meetgreet/customer/@tagid', '\Rystband\Site\Controllers\Meetgreet->meetgreet');
        $f3->route('POST /meetgreet/customer/update/@id', '\Rystband\Site\Controllers\Meetgreet->update');
        $f3->route('GET /meetgreet/confirm/@id', '\Rystband\Site\Controllers\Meetgreet->confirm');
        
          //Meet greet Reg pages
        $f3->route('GET /gatekeeper', '\Rystband\Site\Controllers\Gatekeeper->display');
        $f3->route('GET /gatekeeper/ticket/ok/@ticketid', '\Rystband\Site\Controllers\Gatekeeper->ok');
        $f3->route('GET /gatekeeper/ticket/bad/@ticketid', '\Rystband\Site\Controllers\Gatekeeper->bad');
       

        $f3->route('GET /mc', '\Rystband\Site\Controllers\Mc->display');

        $f3->route('GET /games/raffle', '\Rystband\Site\Controllers\Games\Raffle->display');
        $f3->route('POST /games/raffle/play', '\Rystband\Site\Controllers\Games\Raffle->play');
        $f3->route('GET /games/raffle/winners', '\Rystband\Site\Controllers\Games\Raffle->winners');
        $f3->route('GET /games/raffle/nomorewinners', '\Rystband\Site\Controllers\Games\Raffle->nomorewinners');
        $f3->route('GET /prizepatrol', '\Rystband\Site\Controllers\Prizepatrol->display');

        $f3->route('GET /privacy/policy', '\Rystband\Site\Controllers\Privacy->display');
        
        $f3->route('GET|POST /logout', function() {
             \Base::instance()->clear('SESSION');
             \Base::instance()->clear('COOKIE');
             setcookie('id','',time()-3600);
             \Base::instance()->reroute('/');
        });          
        
        

        // append this app's UI folder to the path
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT') . 'apps/Rystband/Site/Views/', 'Rystband/Site/Views/' );
        

         $f3->route('POST /sysauth', '\Rystband\Site\Controllers\Login->sysauth'); 

         $f3->route('GET /welcome', '\Rystband\Site\Controllers\Home->own');
          $f3->route('GET /share/facebook', '\Rystband\Site\Controllers\Devices\Box\Social->routeFacebook');
          $f3->route('GET /share/twitter', '\Rystband\Site\Controllers\Devices\Box\Social->twitter');

         $f3->route('GET /device/@name', '\Rystband\Site\Controllers\Device->route'); 
         $f3->route('GET /content/@name', '\Rystband\Site\Controllers\Devices\Content->@name');
         $f3->route('GET /content/car', '\Rystband\Site\Controllers\Devices\Content->car');  

        
        
          $f3->route('POST /band/@tagid', '\Rystband\Site\Controllers\Devices\Content->carrequest');
  */
 
        parent::runSite();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
    
    protected function postSite()
    {	
    	$route = $this->app->get('PARAMS.0');
    	if(strpos($_SERVER['REQUEST_URI'], 'user')) {
    		//TODO do I need to force the ryst theme?	
    	} else {
    		$theme = \Dsc\System::instance()->get( 'session' )->get( 'site.theme.override');
    		if($theme) {
    			\Dsc\System::instance()->get('theme')->setTheme($theme, $this->app->get('PATH_ROOT') . 'apps/Themes/'.$theme.'/' );
    			\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/Themes/'.$theme.'/Views/', 'Themes/'.$theme.'/Views' );
    			\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/Rystband/Site/Views/', 'Rystband/Site/Views' );
    		}	
    	}
    	   	
    	parent::postSite();
    
    }

    protected function runAdmin()
    {   
        $f3 = \Base::instance();
        
         /* \Dsc\System::instance()->get('router')->mount( new \Dash\Admin\Routes );
          \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Admin/Views/', 'Dash/Admin/Views' );
          \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Admin\Listener::instance());

          \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Listener::instance());
          \Modules\Factory::registerPositions( array('nav', 'footer', 'above-content', 'below-content') );
          \Modules\Factory::registerPath( $f3->get('PATH_ROOT') . "apps/Dash/Admin/Modules/" );
          \Modules\Factory::registerPositions( array('nav', 'footer', 'above-content', 'below-content') );
          \Modules\Factory::registerPath( $f3->get('PATH_ROOT') . "apps/Dash/Site/Modules/" );
          */

        parent::runAdmin();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }


}
$app = new RystbandBootstrap();
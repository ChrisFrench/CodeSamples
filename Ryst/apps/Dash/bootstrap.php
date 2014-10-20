<?php
class DashBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Dash';

    protected function runSite()
    {
        parent::runSite();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
    protected function runAdmin()
    {   $f3 = \Base::instance();
        \Dsc\System::instance()->get('router')->mount( new \Dash\Admin\Routes );
          \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Admin/Views/', 'Dash/Admin/Views' );
          \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Admin\Listener::instance());
          \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Listener::instance());


          \Modules\Factory::registerPositions( array('nav', 'footer', 'above-content', 'below-content') );
          \Modules\Factory::registerPath( $f3->get('PATH_ROOT') . "apps/Dash/Admin/Modules/" );
          \Modules\Factory::registerPositions( array('nav', 'footer', 'above-content', 'below-content') );
          \Modules\Factory::registerPath( $f3->get('PATH_ROOT') . "apps/Dash/Site/Modules/" );
          

        parent::runAdmin();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }

    protected function runDash()
    {   $f3 = \Base::instance();
        
        \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Site/Views/', 'Dash/Site/Views' );

        \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Admin\Listener::instance());

        
        \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Eventlistener::instance());
        \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Pusherlistener::instance());
        \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Admin\Listener::instance());


        \Dsc\System::instance()->get('router')->mount( new \Dash\Site\Routes );
        \Dsc\System::instance()->get('router')->mount( new \Dash\Site\EventRoutes );
       
        $f3->route('GET|POST /logout', function() {
        \Base::instance()->clear('SESSION');
        \Base::instance()->reroute('/');
        });  
    }

}
$app = new DashBootstrap();

/* $f3 = \Base::instance();
$global_app_name = $f3->get('APP_NAME');

switch ($global_app_name) 
{
    case "dash":
         // register event listener
        \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Eventlistener::instance());
        \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Pusherlistener::instance());
        \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Admin\Listener::instance());
        \Dsc\System::instance()->get('router')->mount( new \Dash\Site\Routes );
        \Dsc\System::instance()->get('router')->mount( new \Dash\Site\EventRoutes );
        
        //$f3->route('GET /signup', '\Dash\Controllers\Auth->showSignup');
        //$f3->route('POST /signup', '\Dash\Controllers\Auth->doSignup');
     /*   $f3->route('GET /admins', '\Dash\Controllers\Placeholder->placeholder'); 
        $f3->route('GET /users', '\Dash\Controllers\Placeholder->placeholder'); 
        $f3->route('GET /prizes', '\Dash\Controllers\Placeholder->placeholder'); 
        $f3->route('GET /attendees', '\Dash\Controllers\Placeholder->placeholder'); 
        $f3->route('GET /wristbands', '\Dash\Controllers\Placeholder->placeholder'); 
        // EVENT ROUTES
        $f3->route('GET|POST /events', '\Dash\Controllers\Events->display');
        $f3->route('GET|POST /events/page/@page', '\Dash\Controllers\Events->display');
        $f3->route('GET|POST /events/delete', '\Dash\Controllers\Events->delete');
        $f3->route('GET /event/create', '\Dash\Controllers\Event->create');
        $f3->route('POST /event/create', '\Dash\Controllers\Event->add');
        $f3->route('GET /event/read/@id', '\Dash\Controllers\Event->read');
        $f3->route('GET /event/edit/@id', '\Dash\Controllers\Event->edit');
        $f3->route('POST /event/edit/@id', '\Dash\Controllers\Event->update');
        $f3->route('DELETE /event/edit/@id', '\Dash\Controllers\Event->delete');
        $f3->route('GET /event/delete/@id', '\Dash\Controllers\Event->delete');  

        $f3->route('GET|POST /@eventid/dashboard', '\Dash\Controllers\Event\Event->display'); 
         $f3->route('GET|POST /@eventid/moveact', '\Dash\Controllers\Event\Activity->movetoattendee');   
        // EVENT ATTENDEES ROUTES
        $f3->route('GET|POST /@eventid/attendees', '\Dash\Controllers\Event\Attendees->display');
        $f3->route('GET|POST /@eventid/attendees/page/@page', '\Dash\Controllers\Event\Attendees->display');
        $f3->route('GET|POST /@eventid/attendees/delete', '\Dash\Controllers\Event\Attendees->delete');
        $f3->route('GET /@eventid/attendee/create', '\Dash\Controllers\Event\Attendee->create');
        $f3->route('GET /@eventid/attendees/tocsv', '\Dash\Controllers\Event\Attendees->toCSV');
        $f3->route('POST /@eventid/attendee/create', '\Dash\Controllers\Event\Attendee->add');
        $f3->route('GET /@eventid/attendee/read/@id', '\Dash\Controllers\Event\Attendee->read');
        $f3->route('GET /@eventid/attendee/edit/@id', '\Dash\Controllers\Event\Attendee->edit');
        $f3->route('POST /@eventid/attendee/edit/@id', '\Dash\Controllers\Event\Attendee->update');
        // EVENT WRISTBANDS ROUTES
        $f3->route('GET|POST /@eventid/wristbands', '\Dash\Controllers\Event\Wristbands->display');
        $f3->route('GET|POST /@eventid/wristbands/page/@page', '\Dash\Controllers\Event\Wristbands->display');
        $f3->route('GET|POST /@eventid/wristbands/delete', '\Dash\Controllers\Event\Wristbands->delete');
        $f3->route('GET /@eventid/wristband/create', '\Dash\Controllers\Event\Wristband->create');
        $f3->route('GET /@eventid/wristband/read/@id', '\Dash\Controllers\Event\Wristband->add');
        $f3->route('GET /@eventid/wristband/edit/@id', '\Dash\Controllers\Event\Wristband->edit');
        $f3->route('POST /@eventid/wristband/edit/@id', '\Dash\Controllers\Event\Wristband->update');
        // EVENT PRIZES ROUTES
        $f3->route('GET|POST /@eventid/prizes', '\Dash\Controllers\Event\Prizes->display');
        $f3->route('GET|POST /@eventid/prizes/page/@page', '\Dash\Controllers\Event\Prizes->display');
        $f3->route('GET|POST /@eventid/prizes/delete', '\Dash\Controllers\Event\Prizes->delete');
        $f3->route('GET /@eventid/prize/create', '\Dash\Controllers\Event\Prize->create');
        $f3->route('GET /@eventid/prize/read/@id', '\Dash\Controllers\Event\Prize->add');
        $f3->route('GET /@eventid/prize/edit/@id', '\Dash\Controllers\Event\Prize->edit');
        $f3->route('POST /@eventid/prize/edit/@id', '\Dash\Controllers\Event\Prize->update');
        // EVENT USERS ROUTES
        $f3->route('GET|POST /@eventid/users', '\Dash\Controllers\Event\Users->display');
        $f3->route('GET|POST /@eventid/users/page/@page', '\Dash\Controllers\Event\Users->display');
        $f3->route('GET|POST /@eventid/users/delete', '\Dash\Controllers\Event\Users->delete');
        $f3->route('GET /@eventid/user/create', '\Dash\Controllers\Event\User->create');
        $f3->route('POST /@eventid/user/create', '\Dash\Controllers\Event\User->add');
        $f3->route('GET /@eventid/user/edit/@id', '\Dash\Controllers\Event\User->edit');
        $f3->route('POST /@eventid/user/edit/@id', '\Dash\Controllers\Event\User->update');
        $f3->route('GET|POST /@eventid/user/delete/@id', '\Dash\Controllers\Event\User->delete');
        // EVENT USER ROLES ROUTES
        $f3->route('GET|POST /@eventid/roles', '\Dash\Controllers\Event\Roles->display');
        $f3->route('GET|POST /@eventid/roles/page/@page', '\Dash\Controllers\Event\Roles->display');
        $f3->route('GET|POST /@eventid/roles/delete', '\Dash\Controllers\Event\Roles->delete');
        $f3->route('GET /@eventid/role/create', '\Dash\Controllers\Event\Role->create');
        $f3->route('GET /@eventid/role/read/@id', '\Dash\Controllers\Event\Role->add');
        $f3->route('GET /@eventid/role/edit/@id', '\Dash\Controllers\Event\Role->edit');
        $f3->route('POST /@eventid/role/edit/@id', '\Dash\Controllers\Event\Role->update');

        $f3->route('GET /@eventid/tags/dashboard', '\Dash\Controllers\Event\Tags->dashboard');
        $f3->route('GET /@eventid/tags/download/@list', '\Dash\Controllers\Event\Tags->download');
        $f3->route('GET /@eventid/tags/generate', '\Dash\Controllers\Event\Tags->generate');
        $f3->route('POST /@eventid/tags/generate', '\Dash\Controllers\Event\Tags->generateTags');

        $f3->route('GET /@eventid/social', '\Dash\Controllers\Event\Social->display');
        
        $f3->route('GET|POST /@eventid/devices', '\Dash\Controllers\Event\Devices->display');
        $f3->route('GET|POST /@eventid/devices/page/@page', '\Dash\Controllers\Event\Devices->display');
        $f3->route('GET|POST /@eventid/devices/delete', '\Dash\Controllers\Event\Devices->delete');
        $f3->route('GET /@eventid/device/create', '\Dash\Controllers\Event\Device->create');
        $f3->route('POST /@eventid/device/create', '\Dash\Controllers\Event\Device->add');
        $f3->route('GET /@eventid/device/edit/@id', '\Dash\Controllers\Event\Device->edit');
        $f3->route('POST /@eventid/device/edit/@id', '\Dash\Controllers\Event\Device->update');
        
        $f3->route('GET|POST /users', '\Dash\Controllers\Users->display');
        $f3->route('GET|POST /users/@page', '\Dash\Controllers\Users->display');
        $f3->route('GET|POST /users/delete', '\Dash\Controllers\Users->delete');
        $f3->route('GET /users/create', '\Dash\Controllers\User->create');
        $f3->route('POST /users/create', '\Dash\Controllers\User->add');
        $f3->route('GET /user/@id', '\Dash\Controllers\User->read');
        $f3->route('GET /user/edit/@id', '\Dash\Controllers\User->edit');
        $f3->route('POST /user/edit/@id', '\Dash\Controllers\User->update');
        $f3->route('DELETE /user/@id', '\Dash\Controllers\User->delete');
        $f3->route('GET /user/delete/@id', '\Dash\Controllers\User->delete');    
      
        $f3->route('GET|POST /logout', function() {
        \Base::instance()->clear('SESSION');
        \Base::instance()->reroute('/');
        });  

        \Dsc\System::instance()->get('theme')->setTheme('default', $f3->get('PATH_ROOT') . 'apps/Dash/Site/Theme/' );
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT') . '/apps/Dash/Site/Views/', 'Dash/Views' );     
        //
        $ui = $f3->get('UI');
        $ui .= ";" . $f3->get('PATH_ROOT') . "apps/Dash/Site/Views/";
        $f3->set('UI', $ui);
        
        // append this app's template folder to the path
        $templates = $f3->get('TEMPLATES');
        $templates .= ";" . $f3->get('PATH_ROOT') . "apps/Dash/Site/Templates/";
        $f3->set('TEMPLATES', $templates);
        
        $f3->route('GET /twitter', 'Dash\Site\Controllers\Event\Social\Twitter->run');

        \Modules\Factory::registerPositions( array('nav', 'footer', 'above-content', 'below-content') );
        \Modules\Factory::registerPath( $f3->get('PATH_ROOT') . "apps/Dash/Site/Modules/" );
        
        
        break;

         case "admin":
          \Dsc\System::instance()->get('router')->mount( new \Dash\Admin\Routes );
          \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Admin/Views/', 'Dash/Admin/Views' );
          \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Admin\Listener::instance());

          \Dsc\System::instance()->getDispatcher()->addListener(\Dash\Listener::instance());
          \Modules\Factory::registerPositions( array('nav', 'footer', 'above-content', 'below-content') );
          \Modules\Factory::registerPath( $f3->get('PATH_ROOT') . "apps/Dash/Admin/Modules/" );
          \Modules\Factory::registerPositions( array('nav', 'footer', 'above-content', 'below-content') );
          \Modules\Factory::registerPath( $f3->get('PATH_ROOT') . "apps/Dash/Site/Modules/" );
          
         break;

         case 'cli':
            $f3->route('GET /twitter', 'Dash\Site\Controllers\Event\Social\Twitter->run');
            $f3->route('GET /facebook', 'Dash\Site\Controllers\Event\Social\Facebook->run');
        

             # code...
             break;
}
?>*/
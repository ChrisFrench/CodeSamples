
<?php
//ini_set('session.gc_maxlifetime', 36000);
//session_set_cookie_params(36000);
//if(!empty($_COOKIE['id'])) {
//session_id($_COOKIE['id']);
//}
$app = require('../vendor/bcosca/fatfree/lib/base.php');

//Fix for MS phones sessions getting a blank host
$app->set('HOST', $_SERVER['HTTP_HOST']);

$app->set('PATH_ROOT', __dir__ . '/../');
$app->set('AUTOLOAD',
        $app->get('PATH_ROOT') . 'lib/;' .
        $app->get('PATH_ROOT') . 'apps/;'
);
//LOAD database information and systeom config
$app->config( $app->get('PATH_ROOT') . 'config/common.config.ini');
//AUTOLOAD everything from composer
(@include_once ($app->get('PATH_ROOT') . 'vendor/autoload.php')) OR die("You need to run php composer.phar install for your application to run.");
//SET JIG WRITEPATH
$app->set('db.jig.dir', $app->get('PATH_ROOT') . 'jig/');
//Set the default actions to site, site is the forward normal user app.
$app->set('APP_NAME', 'site');
//Lets query for the subdomain
$app->set('sub', strtolower(explode(".",$_SERVER['HTTP_HOST'])[0]));
//dashboard.rystband.com/ the premissions will come from the user
if ($app->get('sub') == 'dashboard') {
    $app->set('APP_NAME', 'dash');
}

//This is the f3-admin app, the routes are admin.rystband.com/admin
if ($app->get('sub') == 'admin') {
    //TODO add some whitelisted IP addresses for security
    $app->set('APP_NAME', 'admin');
}
if (strpos(strtolower($app->get('URI')), $app->get('BASE') . '/admin') !== false)
{
    $app->set('APP_NAME', 'admin');
}

//This is the f3-admin app, the routes are admin.rystband.com/admin
if ($app->get('sub') == 'api') {
	//TODO add some whitelisted IP addresses for security
	$app->set('APP_NAME', 'api');
}

//OK we now check to see if we are not any of the other situations and if so we load the company data
/*if($app->get('sub') != 'admin' && $app->get('sub') != 'dashboard' && !empty($app->get('sub') && $app->get('sub') != 'rystband'  && $app->get('sub') != 'www' ) ) {
//HERE WE CAN CHECK THIS IT IS A VALID EVENT REGISTERED AND SUCH
$model = new \Dash\Models\Customers;
$item = $model->setCondition('subdomain', $app->get('sub'))->getItem();
$app->set('SESSION.customer', $item );
$app->set('APP_NAME', 'site');
}*/

//IF the the user agent contains crosscliq, lets  run a device.
if (strpos($app->get('AGENT'), 'CROSSCLIQ')) {
    $app->set('APP_NAME', 'device');
}
$logger = new \Log( $app->get('application.logfile') );
\Registry::set('logger', $logger);

if ($app->get('DEBUG')) {
    ini_set('display_errors',1);
}
// Lets look inside of experiences for bootstraping
$additional_paths = array();
$additional_paths[] = $app->get('PATH_ROOT'). 'apps/Experiences/';
// bootstap each mini-app
\Dsc\Apps::instance()->bootstrap(null, $additional_paths );
// load routes
\Dsc\System::instance()->get('router')->registerRoutes();
// trigger the preflight event
\Dsc\System::instance()->preflight();
$app->route('GET /csv', '\Rystband\Site\Controllers\Home->makeDataCSV');

//echo $app->get('APP_NAME');
//die();
/*
$db_name = \Base::instance()->get('db.mongo.name');
$db = new \DB\Mongo('mongodb://localhost:27017', $db_name);
new \DB\Mongo\Session($db);
*/
//$app->route('POST /barcodeid/register', '\Experiences\Barcodeid\Site\Controllers\Controller->register');
//$app->route('GET /csv', '\Rystband\Site\Controllers\Home->makeDataCSV');
//$app->route('GET /syncdb', '\Rystband\Site\Controllers\Home->syncDB');
//$app->route('GET /divreport', '\Rystband\Site\Controllers\Home->divReport');
//$app->route('GET /@eventid/magic', '\Rystband\Site\Controllers\Event\Employee\Magic->magic');


/*$app->route('GET /montreal/prize/manager', function() {
	$f3 = \Base::instance();
	 \Dsc\System::instance()->get('theme')->setTheme('Bell', $f3->get('PATH_ROOT') . 'apps/Themes/Bell/' );
  	$view = \Dsc\System::instance()->get( 'theme' );
   	$model = new \Dash\Site\Models\Event\Prizes;
    $model->setEvent('5367c5b623195a89b90041a7');
    $model->setCondition('type', 'bell');
    $totalBell = $model->getItems();
 	echo $view->render('Rystband/Site/Views::event/employee/prizes/manage.php');


});

$app->route('GET|POST /montreal/game/addprize', function() {
	$date = new DateTime();
	$date->setTimezone( new DateTimeZone('America/Vancouver'));
	$model = new \Dash\Site\Models\Event\Prizes;
    $model->setEvent('5367c5b623195a89b90041a7');
    $model->name = 'Bell Prize';
    $model->type = 'bell';
    $model->winbytime = $date->format('Y/m/d H:i');
    $model->create();
    
    \Dsc\System::instance()->addMessage( 'Added a Bell Prize', 'message');
	\Base::instance()->reroute('/montreal/prize/manager');
});

$app->route('GET|POST /montreal/game/addsamsung', function() {
	$date = new DateTime();
	$date->setTimezone( new DateTimeZone('America/Vancouver'));
	$model = new \Dash\Site\Models\Event\Prizes;
    $model->setEvent('5367c5b623195a89b90041a7');
    $model->name = 'Bell Prize';
    $model->type = 'samsung';
    $model->winbytime = $date->format('Y/m/d H:i');
    $model->create();
    
      \Dsc\System::instance()->addMessage( 'Added a Samsung Prize', 'message');
	\Base::instance()->reroute('/montreal/prize/manager');
});

$app->route('GET|POST /montreal/game/addsamsung', function() {
    $date = new DateTime();
    $date->setTimezone( new DateTimeZone('America/Vancouver'));
    $model = new \Dash\Site\Models\Event\Prizes;
    $model->setEvent('5367c5b623195a89b90041a7');
    $model->name = 'Bell Prize';
    $model->type = 'samsung';
    $model->winbytime = $date->format('Y/m/d H:i');
    $model->create();
    
      \Dsc\System::instance()->addMessage( 'Added a Samsung Prize', 'message');
    \Base::instance()->reroute('/montreal/prize/manager');
}); */






     
  

$app->run();
?>

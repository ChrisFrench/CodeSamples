<?php
if(php_sapi_name() == 'cli' || empty($_SERVER['REMOTE_ADDR'])) {

define('PATH_ROOT', realpath( __dir__ . '/../' ) . '/' );

$app = require( PATH_ROOT . 'vendor/bcosca/fatfree/lib/base.php');

$app->set('PATH_ROOT', PATH_ROOT);
$app->set('AUTOLOAD',
        $app->get('PATH_ROOT') . 'lib/;' .
        $app->get('PATH_ROOT') . 'apps/;'
);

require $app->get('PATH_ROOT') . 'vendor/autoload.php';

$app->set('APP_NAME', 'cli');

// common config
$app->config( $app->get('PATH_ROOT') . 'config/cli.config.ini');
// for CLI apps:
$app->set('LOGS', $app->get('PATH_ROOT') . 'logs/');
$app->set('TEMP', $app->get('PATH_ROOT') . 'tmp/');
$app->set('db.jig.dir', $app->get('PATH_ROOT') . 'jig/');
echo $app->get('db.jig.dir'); die();
$logger = new \Log( $app->get('application.logfile') );
\Registry::set('logger', $logger);

if ($app->get('DEBUG')) {
    ini_set('display_errors',1);
}
// bootstap each mini-app
\Dsc\Apps::instance()->bootstrap();

// trigger the preflight event
\Dsc\System::instance()->preflight();

$app->run();
}
else {
	echo 'command line only';
}

?>
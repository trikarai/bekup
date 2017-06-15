<?php
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');



try {
    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();
	
    require_once __DIR__ . "/../vendor/autoload.php";
    include APP_PATH . '/config/doctrine_config.php';
    include APP_PATH . '/config/services.php';
	$config = $di->getConfig();
    include APP_PATH . '/config/router.php';
    include APP_PATH . '/config/loader.php';

    $application = new \Phalcon\Mvc\Application($di);
    echo $application->handle()->getContent();
} catch (\Exception $e) {
	echo "HTTP ERROR 500";
	echo $e->getMessage() . '<br>';
	echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
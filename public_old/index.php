<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Config\Adapter\Ini as ConfigIni;

error_reporting(E_ALL);

// define('APP_PATH', realpath('..') . '/');
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    // $di = new FactoryDefault();
	$config = new ConfigIni(APP_PATH . '/config/config.ini');

    /**
     * Include composer autoloader
     */
    require_once __DIR__ . "/../vendor/autoload.php";
	
    /**
     * Handle routes
     */
    // include APP_PATH . '/config/router.php';

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';
   
    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';
    // include APP_PATH . '/config/router.php';

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

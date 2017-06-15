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

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';
    
    /**
     * Include composer autoloader
     */
    require_once __DIR__ . "/../vendor/autoload.php";
   
    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    // echo '<pre>' . $e->getTraceAsString() . '</pre>';
    // echo $e->getMessage() . '<br>';
	include "error.volt";
    // echo <<<_END
		// <h2>HTTP Error 500 </h2>
		// <br/>
		// <br/>
		// <a href='http://bekup.info/index'>Back to Home </a>
// _END;
}

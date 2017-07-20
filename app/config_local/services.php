<?php

use Phalcon\Mvc\View;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Events\Manager as EventsManager;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * We register the events manager
 */
 
//security checking is temporarily disabled	

 $di->set('dispatcher', function() use ($di) {
	 $eventsManager = new EventsManager;
	 $security = new Security($di);
	 $eventsManager->attach('dispatch', $security);
	
	 $dispatcher = new Dispatcher;
	 $dispatcher->setEventsManager($eventsManager);

	 return $dispatcher;
 });

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function() use ($config){
	$url = new UrlProvider();
	$url->setBaseUri($config->application->baseUri);
	return $url;
});


$di->set('view', function() use ($config) {

	$view = new View();

	$view->setViewsDir(BASE_PATH . "/" . $config->application->viewsDir);

	$view->registerEngines(array(
		".volt" => 'volt'
	));

	return $view;
});

/**
 * Setting up volt
 */
$di->set('volt', function($view, $di) {

	$volt = new VoltEngine($view, $di);

	$volt->setOptions(array(
		"compiledPath" => BASE_PATH . "/" . "cache/volt/"
	));

	$compiler = $volt->getCompiler();
	$compiler->addFunction('is_a', 'is_a');

	return $volt;
}, true);

/**
 * Start the session the first time some component request the session service
 */
$di->set('session', function() {
	$session = new SessionAdapter();
	$session->start();
	return $session;
});

/**
 * Register the flash service with custom CSS classes
 */
$di->set('flash', function(){
	return new FlashSession(array(
		'error'   => 'alert alert-danger',
		'success' => 'alert alert-success',
		'notice'  => 'alert alert-info',
	));
});


/**
 * Register a user component
 */
$di->set('elements', function(){
	return new Elements();
});
$di->set('sysAdminElements', function(){
	return new SysAdminElements();
});
$di->set('router', function(){
    require APP_PATH . '/config/router.php';
    return $router;
});

/**
* Register Doctrine EntityManager
*/
include APP_PATH . '/config/doctrineConfig.php';
$di->set('entityManager', function() use ($entityManager){
	return $entityManager;
});
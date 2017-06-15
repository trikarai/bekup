<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions([
                'compiledPath' => $config->application->cacheDir,
                'compiledSeparator' => '_'
            ]);

            return $volt;
        },
    ]);

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->userName,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});

require_once BASE_PATH . "/vendor/autoload.php";

$isDevMode = true;
$paths = array(
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/Doctrine/Mapping/Personnel",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/Doctrine/Mapping/City",
    BASE_PATH . "/src/Usage/Infrastructure/Persistence/Doctrine/Mapping/Talent",
    BASE_PATH . "/src/Usage/Infrastructure/Persistence/Doctrine/Mapping/TalentJobHistory",
    BASE_PATH . "/src/Usage/Infrastructure/Persistence/Doctrine/Mapping/City",
    
);
$allPaths = array(
	BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/City",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/CityClass",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/Course",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/CourseClass",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/Personnel",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/Skill",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/Track",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/TeamClass",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/CityTeamClass",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Profile",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Certificate",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Education",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Skill",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/TalentClass",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Training",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Work",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Team",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/AsTeamMember",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/TeamClass",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Superhero",
    BASE_PATH . "/src/Region/Infrastructure/Persistence/DoctrineMapping/City",
    BASE_PATH . "/src/Region/Infrastructure/Persistence/DoctrineMapping/CityTeamClass",
    BASE_PATH . "/src/Region/Infrastructure/Persistence/DoctrineMapping/Team",
);

$config = Setup::createXMLMetadataConfiguration($allPaths, $isDevMode);

$conn = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'pr4jaB1',
    'dbname' => 'bekup'
);

$entityManager = EntityManager::create($conn, $config);

/**
 *  Set Entity Manager Service to Service Container 
 */

$di->set('entityManager', function () use ($entityManager) {
    return $entityManager;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter(
	array(
		'bekup-session'
	)
	);
    $session->start();

    return $session;
});

$di->set('dispatcher', function() use ($di) {
	$eventsManager = $di->getShared('eventsManager');

	$security = new Bekupsecurity($di);
	$eventsManager->attach('dispatch', $security);

	$dispatcher = new Phalcon\Mvc\Dispatcher();
	$dispatcher->setEventsManager($eventsManager);

	return $dispatcher;
});


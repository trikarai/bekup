<?php

$loader = new \Phalcon\Loader();

$loader->registerNamespaces([
    "Team" => APP_PATH . "/controllers/team/",
    "Talent" => APP_PATH . "/controllers/talent/",
]);
$loader->registerDirs(
    array(
        BASE_PATH . "/" . $config->application->controllersDir,
        BASE_PATH . "/" . $config->application->libraryDir,
        BASE_PATH . "/" . $config->application->pluginsDir,
    )
);
$loader->register();
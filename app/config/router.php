<?php

$router = new Phalcon\Mvc\Router();

$router->add(
        "/team/:controller/:action/:params",
        [
            "namespace" => "Team",
            "controller" => 1,
            "action" => 2,
            "params" => 3,
        ]
);
$router->add(
        "/talent/:controller/:action/:params",
        [
            "namespace" => "Talent",
            "controller" => 1,
            "action" => 2,
            "params" => 3,
        ]
);

// $router->notFound(array(
	// "controller" => 'index',
	// "action" => 'error404',
// ));

return $router;
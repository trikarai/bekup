<?php

use Phalcon\Mvc\Controller;
use Doctrine\ORM\EntityManager;


class ControllerBase extends Controller
{
    /**
    *	@var EntityManager
    */
    protected $em;

    protected function initialize(){
    Phalcon\Tag::prependTitle('Bekup 2.0 | ');
    $this->em = $this->entityManager;
    }

    protected function forward($uri){
    $uriParts = explode('/', $uri);
    return $this->dispatcher->forward(
    array(
        'controller' => $uriParts[0], 
        'action' => $uriParts[1]
    )
    );
    }
}

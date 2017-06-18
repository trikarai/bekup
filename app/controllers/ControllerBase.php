<?php

use Phalcon\Mvc\Controller;
use Doctrine\ORM\EntityManager;

class ControllerBase extends Controller {

    /**
     * 	@var EntityManager
     */
    protected $em;

    protected function initialize() {
        Phalcon\Tag::prependTitle('Bekup 2.0 | ');
        $this->em = $this->entityManager;
    }

    protected function forward($uri) {
        $uriParts = explode('/', $uri);
        return $this->dispatcher->forward(
                        array(
                            'controller' => $uriParts[0],
                            'action' => @$uriParts[1] // add @ on variable to supress error Notice: Undefined offset: 1
                        )
        );
    }
    protected function forwardNamespace($uri){
        $uriParts = explode('/', $uri);
        return $this->dispatcher->forward(
                        array(
                            'namespace' => $uriParts[0],
                            'controller' => $uriParts[1],
                            'action' => @$uriParts[2] // add @ on variable to supress error Notice: Undefined offset: 1
                        )
        );
    }

    protected function displayErrorMessages(array $details) {
        foreach ($details as $detail) {
            $this->flash->error($detail);
        }
    }
    
    protected function displayWarningMessages(array $details) {
        foreach ($details as $detail) {
            $this->flash->warning($detail);
        }
    }

}

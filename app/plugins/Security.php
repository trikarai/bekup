<?php

use Phalcon\Events\Event,
    Phalcon\Mvc\User\Plugin,
    Phalcon\Mvc\Dispatcher,
    Phalcon\Acl;

/**
 * Security
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class Security extends Plugin {

    public function __construct($dependencyInjector) {
        $this->_dependencyInjector = $dependencyInjector;
    }

    protected function _grantAccessToRole($acl, $resources, $roleName){
        foreach ($resources as $resource => $actions) {
            $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
            foreach($actions as $action){
                $acl->allow($roleName, $resource, $action);
            }
        }
    }
    protected function _manageGuestRole($acl){
        $guestResources = array(
            'login' => array('index', 'login'),
            'manager' => array('index', 'login'),
            'register' => array('*'),
        );
        $this->_grantAccessToRole($acl, $guestResources, 'Guest');
    }
    protected function _manageDirectorRole($acl){
        $directorResources = array(
            'personnel' => ['*'],
            'city' => ['*'],
            'track' => ['*'],
            'programme' => ['*'],
            'manager' => ['logout'],
            'managerial' => ['*'],
        );
        $this->_grantAccessToRole($acl, $directorResources, 'Director');
    }
    protected function _manageTalentRole($acl){
        $talentResources = array(
            'Talent:dashboard' => ['*'],
            'Talent:education' => ['*'],
            'Talent:entrepreneurship' => ['*'],
            'Talent:organizational' => ['*'],
            'Talent:profile' => ['*'],
            'Talent:skill' => ['*'],
            'Talent:superhero' => ['*'],
            'Talent:training' => ['*'],
            'Talent:workexperience' => ['*'],
            'Team:dashboard' => ['*'],
            'Team:idea' => ['*'],
            'Team:invitation' => ['*'],
            'Team:member' => ['*'],
            'Team:profile' => ['*'],
            'Team:programme' => ['*'],
            'login' => ['logout'],
        );
        $this->_grantAccessToRole($acl, $talentResources, 'Talent');
    }
    
    public function getAcl() {
        $acl = new Phalcon\Acl\Adapter\Memory();
        $acl->setDefaultAction(Phalcon\Acl::DENY);
//Register roles
        $roles = array(
            'director' => new Phalcon\Acl\Role('Director'),
            'trackCoordinator' => new Phalcon\Acl\Role('Track Coordinator'),
            'regionCoordinator' => new Phalcon\Acl\Role('Region Coordinator'),
            'tutor' => new Phalcon\Acl\Role('Tutor'),
            'talent' => new Phalcon\Acl\Role('Talent'),
            'guest' => new Phalcon\Acl\Role('Guest'),
        );
        foreach ($roles as $role) {
            $acl->addRole($role);
        }
//public resourcees
        $publicResources = array(
            'index' => array('index'),
        );
        foreach ($publicResources as $resource => $actions) {
            $acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
        }
//Grant access to public areas to all roles
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                $acl->allow($role->getName(), $resource, '*');
            }
        }
        
        $this->_manageDirectorRole($acl);
        $this->_manageTalentRole($acl);
        $this->_manageGuestRole($acl);
        
//The acl is stored in session, APC would be useful here too
        $this->persistent->acl = $acl;
        return $this->persistent->acl;
    }

    /**
     * This action is executed before execute any action in the application
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher) {
        $auth = $this->session->get('auth');
        if (!$auth) {//not logged in; treat as Guest
            $role = 'Guest';
        } else {
            $role = $auth['role'];
        }

        $namespace = $dispatcher->getNamespaceName();
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        $acl = $this->getAcl();
        if(!empty($namespace)){
            $controller = $namespace . ":" . $controller;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);
        if ($allowed != Acl::ALLOW) {
            $this->flash->error("You're not allowed to access this resource '$controller $action'");
            if ($role === 'Guest') {
                $dispatcher->forward(array(
                    'controller' => 'index',
                    'action' => 'index'
                ));
            } elseif ($role === 'Director') {
                $dispatcher->forward(array(
                    'controller' => 'managerial',
                    'action' => 'dashboard'
                ));
            } elseif ($role == 'Talent') {
                $dispatcher->forward(array(
                    'namespace' => 'Talent',
                    'controller' => 'dashboard',
                    'action' => 'index'
                ));
            }
            return false;
        }
    }
}

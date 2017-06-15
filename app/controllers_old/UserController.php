<?php

use Phalcon\Tag as Tag;

class UserController extends ControllerBase{
	function initialize()
    {
        $this->view->setTemplateAfter('userDashboard');
		
        parent::initialize();
    }
	function indexAction(){
        Phalcon\Tag::setTitle('User Dashboard');
    }
	
}
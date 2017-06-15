<?php

use Phalcon\Tag as Tag;

class ManagementController extends ControllerBase{
	function initialize()
    {
        $this->view->setTemplateAfter('managementDashboard');
		
        parent::initialize();
    }
	function indexAction(){
        Phalcon\Tag::setTitle('Management Dashboard');
    }
	
}
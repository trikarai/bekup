<?php

use Phalcon\Tag as Tag;

class AdminController extends ControllerBase{
	function initialize()
    {
        $this->view->setTemplateAfter('adminDashboard');
		
        parent::initialize();
    }
	function indexAction(){
        Phalcon\Tag::setTitle('Admin Dashboard');
    }
	
}
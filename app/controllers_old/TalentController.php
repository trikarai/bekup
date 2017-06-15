<?php

use Phalcon\Tag as Tag;

class TalentController extends ControllerBase{
	function initialize()
    {
        $this->view->setTemplateAfter('talentDashboard');
		
        parent::initialize();
    }
	function indexAction(){
        Phalcon\Tag::setTitle('Talent Dashboard');
    }
	
}
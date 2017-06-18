<?php

class TalentControllerBase extends ControllerBase {

    function initialize() {
        $this->view->setTemplateAfter('talentTemplate');
        parent::initialize();
    }
    
    function _getTalentId(){
        return $this->session->get('auth')['id'];
    }

}

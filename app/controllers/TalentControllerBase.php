<?php

class TalentControllerBase extends ControllerBase {

    function initialize() {
        $this->view->setTemplateAfter('talent');
        parent::initialize();
    }
    
    function _getTalentId(){
        return $this->session->get('auth')['id'];
    }

}

<?php

use Personnel\ApplicationService\Personnel\PersonnelFinder;

class ManagerialControllerBase extends ControllerBase{
    function initialize(){
            $this->view->setTemplateAfter('managerDashboard');
            parent::initialize();
    }
    
    protected function _getPersonnelId(){
        return $this->session->get('auth')['id'];
    }
    protected function _personnelRdoRepository(){
        return $this->em->getRepository('\Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject');
    }
}
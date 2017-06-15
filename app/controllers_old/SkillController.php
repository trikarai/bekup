<?php

use Managerial\Application\Service\Skill\AddSkillService;
use Managerial\Application\Service\Skill\UpdateSkillService;
use Managerial\Application\Service\Skill\ShowSkillService;
use Managerial\Domain\Model\Skill\Exception\SkillNotFoundException;


class SkillController extends ControllerBase{
    public function indexAction(){
        $skillRepository = $this->em->getRepository('\Managerial\Domain\Model\Skill\Skill');
        $service = new ShowSkillService($skillRepository);
        $skillDTOs = $service->showAll();
        $this->view->skillDTOs = $skillDTOs;
    }

    public function addAction(){

    }

    public function newAction() {

    }

    public function editAction(){

    }

    public function updateAction(){

    }

    public function removeAction(){

    }
}

?>
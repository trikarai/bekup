<?php

namespace Talent;

use Phalcon\Tag;

use Talent\Profile\ApplicationService\Talent\QueryTalentService;
use Talent\Profile\ApplicationService\Talent\UpdateTalentService;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;
use Superclass\DomainModel\Talent\TalentReadDataObject;
use Talent\Education\ApplicationService\Education\QueryEducationService;
use Talent\Education\DomainModel\Education\DataObject\EducationReadDataObject;
use Talent\WorkingExperience\ApplicationService\WorkingExperience\QueryWorkingExperienceService;
use Talent\WorkingExperience\DomainModel\WorkingExperience\DataObject\WorkingExperienceWriteDataObject;
use Talent\Training\ApplicationService\Training\QueryTrainingService;

class ProfileController extends \TalentControllerBase{
    
    function indexAction(){
        $this->view->pick('talent/profile/index');
        $this->view->profileRdo = $this->_talentProfileRdo();
        $this->view->workingExperienceRdos = $this->_talentWorkingExperienceRdos();
        $this->view->educationRdos = $this->_talentEducationRdos();
        $this->view->trainingRdos = $this->_talentTrainingRdos();
    }
    
    function editAction(){
        $this->view->pick('talent/profile/edit');
        $this->view->genderList = ['M' => "Male", "F" => "Female"];
        $profileRdo = $this->_talentProfileRdo();
        Tag::displayTo('name',$profileRdo->getName());
        Tag::displayTo('phone',$profileRdo->getPhone());
        Tag::displayTo('email',$profileRdo->getEmail());
        Tag::displayTo('birthdate',$profileRdo->getBirthDate()); 
        Tag::displayTo('city_of_origin',$profileRdo->getCityOfOrigin());
        Tag::displayTo('gender',$profileRdo->getGender());
        Tag::displayTo('bekup_type',$profileRdo->getBekupType());
        Tag::displayTo('motivation',$profileRdo->getMotivation());
    }

    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('talent/profile/index');
        }
        $talentRepository = $this->em->getRepository('\Talent\Profile\DomainModel\Talent\Talent');
        $service = new UpdateTalentService($talentRepository);
        
        $response = $service->execute($this->_getTalentId(), $this->_getRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forwardNamespace('Talent/profile/edit');
        }
        $this->flash->success("profile updated");
        return $this->forwardNamespace('Talent/profile/index');
    }
    
    /**
     * @return TalentReadDataObject
     */
    protected function _talentProfileRdo(){
        $talentRdoRepository = $this->em->getRepository('\Superclass\DomainModel\Talent\TalentReadDataObject');
        $service = new  QueryTalentService($talentRdoRepository);
        $response = $service->showOneById($this->_getTalentId());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $response->firstReadDataObject();
    }
    /**
     * @return EducationReadDataObject[]
     */
    protected function _talentEducationRdos(){
        $talentRepository = $this->em->getRepository('\Talent\Education\DomainModel\Talent\Talent');
        $service = new QueryEducationService($talentRepository);
        $response = $service->showAll($this->_getTalentId());
        return $this->_getArrayOfRdos($response);
    }
    /** 
     * @return WorkingExperienceWriteDataObject[] 
     */
    protected function _talentWorkingExperienceRdos(){
        $talentRepository = $this->em->getRepository('\Talent\WorkingExperience\DomainModel\Talent\Talent');
        $service = new QueryWorkingExperienceService($talentRepository);
        $response = $service->showAll($this->_getTalentId());
        return $this->_getArrayOfRdos($response);

    }
    /**
     * @return TrainingReadDataObject[]
     */
    protected function _talentTrainingRdos(){
        $talentRepository = $this->em->getRepository('\Talent\Training\DomainModel\Talent\Talent');
        $service = new QueryTrainingService($talentRepository);
        $response = $service->showAll($this->_getTalentId());
        return $this->_getArrayOfRdos($response);
    }

    protected function _getArrayOfRdos(\Resources\QueryResponseObject $response){
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $response->arrayOfReadDataObject();
    }
    
    protected function _getRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $phone = strip_tags($this->request->getPost('phone'));
        $email = strip_tags($this->request->getPost('email'));
        $birthDate = strip_tags($this->request->getPost('birthdate'));
        $cityOfOrigin = strip_tags($this->request->getPost('city_of_origin'));
        $gender = strip_tags($this->request->getPost('gender'));
        $motivation = strip_tags($this->request->getPost('motivation'));
        return TalentWriteDataObject::updateRequest($name, $email, $phone, $cityOfOrigin, $birthDate, $gender, $motivation);
    }
}
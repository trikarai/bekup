<?php
use Phalcon\Tag;

use Talent\Application\Service\TalentProfile\DTO\CommandTalentDTO;
use Talent\Application\Service\TalentProfile\CommandTalentService;
use Talent\Application\Service\TalentProfile\QueryTalentService;
use Talent\Domain\Model\Course\Exception\DuplicateTalentApplicationException;

use Talent\Application\Service\Education\DTO\CommandEducationDTO;
use Talent\Application\Service\Education\CommandEducationService;
use Talent\Application\Service\Education\QueryEducationService;
use Talent\Domain\Model\Education\Exception\EducationNotFoundException;

use Talent\Application\Service\Certificate\DTO\CommandCertificateDTO;
use Talent\Application\Service\Certificate\CommandCertificateService;
use Talent\Application\Service\Certificate\QueryCertificateOwnedService;
use Talent\Domain\Model\Certificate\Exception\CertificateNotFoundException;

use Talent\Application\Service\Work\DTO\CommandWorkDTO;
use Talent\Application\Service\Work\CommandWorkService;
use Talent\Application\Service\Work\QueryWorkService;
use Talent\Domain\Model\Work\Exception\WorkNotFoundException;

use Talent\Application\Service\Skill\DTO\CommandTalentSkillDTO;
use Talent\Application\Service\Skill\QueryTalentSkillService;
use Talent\Application\Service\Skill\CommandTalentSkillService;
use Talent\Domain\Model\Skill\Exception\DuplicateSkillException;

use Talent\Application\Service\Training\DTO\CommandTrainingDTO;
use Talent\Application\Service\Training\CommandTrainingService;
use Talent\Application\Service\Training\QueryTrainingService;
use Talent\Application\Service\Skill\RemoveTalentSkillService;
use Talent\Domain\Model\Training\Exception\TrainingNotFoundException;

use Managerial\Application\Service\City\Helper\ExternalCityFinderHelper;
use Managerial\Application\Service\Track\Helper\ExternalTrackFinderHelper;

class TalentController extends ControllerBase{
    function indexAction(){
        if(!$this->_getSessionId()){return $this->forward('login');}
        $service = new QueryTalentService($this->_getTalentRepository(),$this->_externalCityFinderHelper(), $this->_externalTrackFinderHelper());
        $talentDTO = $service->execute($this->_getSessionId());
        $this->view->talentDTO = $talentDTO;
        
    }
    function editAction(){
        $service = new QueryTalentService($this->_getTalentRepository(), $this->_externalCityFinderHelper(), $this->_externalTrackFinderHelper());
        $talentDTO = $service->execute($this->_getSessionId());
        Tag::displayTo('name',$talentDTO->name());
        Tag::displayTo('phone',$talentDTO->phone());
        Tag::displayTo('email',$talentDTO->email());
        Tag::displayTo('birthdate',$talentDTO->birthDate()); 
        Tag::displayTo('domicile',$talentDTO->cityOfOrigin());
        Tag::displayTo('cityId',$talentDTO->queryCityDTO()->id());
        Tag::displayTo('trackId',$talentDTO->queryTrackDTO()->id());
    }
    function updateAction(){
        if(!$this->request->isPost()){return $this->forward('talent/index');}
        $name = strip_tags($this->request->getPost('name'));
        $phone = strip_tags($this->request->getPost('phone'));
        $email = strip_tags($this->request->getPost('email'));
        $birthDate = strip_tags($this->request->getPost('birthdate'));
        $cityOfOrigin = strip_tags($this->request->getPost('domicile'));
        $cityId = strip_tags($this->request->getPost('cityId'));
        $trackId = strip_tags($this->request->getPost('trackId'));
        
        $request = CommandTalentDTO::updateRequest($name, $email, $phone, $birthDate, $cityOfOrigin, $cityId, $trackId);
        $service = new CommandTalentService($this->_getTalentRepository(), $this->_externalCityFinderHelper(), $this->_externalTrackFinderHelper());
        try{
            $service->update($request, $this->_getSessionId());
            $this->flash->success('Talent Updated');
        } catch (DuplicateTalentApplicationException $e){
            $this->flash->error('Update Failed ' + $e);
        }
        return $this->forward('talent/index');
    }
     /*
     * Education History
     */
    public function educationAction(){  
        $service = new QueryEducationService($this->_talentEducationRepository());
        $educationHistoryDTOs = $service->showAll($this->_getSessionId());
        $this->view->educationHistoryDTOs = $educationHistoryDTOs;
    }
    public function addEducationAction(){}
    public function saveEducationAction(){
        if(!$this->request->isPost()){return $this->forward('talent/education');}
            $phase = strip_tags($this->request->getPost('phase'));
            $institution = strip_tags($this->request->getPost('institution'));
            $major = strip_tags($this->request->getPost('major'));
            $startYear = strip_tags($this->request->getPost('start_year'));
            $endYear = strip_tags($this->request->getPost('end_year'));
            $request = CommandEducationDTO::addRequest($phase, $institution, $major, $startYear, $endYear);
            $service = new CommandEducationService($this->_talentEducationRepository());
            try{
                $service->add($request, $this->_getSessionId());
                $this->flash->success('Education History Added');
            } catch (EducationNotFoundException $e){
                $this->flash->error('Fail Add Education History '+ $e);
            }
            return $this->forward('talent/education');  
    }
    public function editEducationAction($educationHistoryId){
        $service = new QueryEducationService($this->_talentEducationRepository());
        $educationDTO = $service->showById($educationHistoryId, $this->_getSessionId());
        Tag::displayTo('id',$educationDTO->id());
        Tag::displayTo('phase',$educationDTO->phase());
        Tag::displayTo('institution',$educationDTO->institution());
        Tag::displayTo('major',$educationDTO->major());
        Tag::displayTo('start_year',$educationDTO->startYear());
        Tag::displayTo('end_year',$educationDTO->endYear());
    }
    public function updateEducationAction(){
        if(!$this->request->isPost()){return $this->forward('talent/education');}
            $id = strip_tags($this->request->getPost('id'));
            $institution = strip_tags($this->request->getPost('institution'));
            $major = strip_tags($this->request->getPost('major'));
            $startYear = strip_tags($this->request->getPost('start_year'));
            $endYear = strip_tags($this->request->getPost('end_year'));
        $request = CommandEducationDTO::updateRequst($id, $institution, $major, $startYear, $endYear);
        $service = new CommandEducationService($this->_talentEducationRepository());
        try {
            $service->update($request, $this->_getSessionId());
            $this->flash->success("Education History Updated");
        } catch (EducationNotFoundException $ex) {
            $this->flash->error("Fail to Update Education History ");
        }
        return $this->forward('talent/education');
    }
    public function removeEducationAction($educationHistoryId){
        $service = new CommandEducationService($this->_talentEducationRepository());
        try{
            $service->remove($educationHistoryId, $this->_getSessionId());
            $this->flash->success("Education History Removed");
        } catch (EducationHistoryNotFoundException $ex){
            $this->flash->error("Fail to Remove Education History ");
        }
        return $this->forward('talent/education');
    }
    /*
     * Job History
     */
    public function jobAction(){
        $service = new QueryWorkService($this->_talentWorkExperienceRepository());;
        $jobHistoryDTOS = $service->showAll($this->_getSessionId());
        $this->view->jobHistoryDTOs = $jobHistoryDTOS;       
    }
    public function addJobAction(){}
    public function saveJobAction(){
        if(!$this->request->isPost()){return $this->forward("talent/job");}
        $companyName = strip_tags($this->request->getPost('companyName'));
        $position = strip_tags($this->request->getPost('position'));
        $startWorkingTime = strip_tags($this->request->getPost('startYear'));
        $endWorkingTime = strip_tags($this->request->getPost('endYear'));
        $role = strip_tags($this->request->getPost('role'));
        $request = CommandWorkDTO::addRequest($companyName, $position, $startWorkingTime, $endWorkingTime, $role);
        $service = new CommandWorkService($this->_talentWorkExperienceRepository());
        try {
            $service->add($request, $this->_getSessionId());
            $this->flash->success("Job History Added");
        } catch (WorkNotFoundException $ex) {
            $this->flash->error("Fail to Add Job History ");
        }
        return $this->forward('talent/job');
    }
    public function editJobAction($jobHistoryId){
        $service = new QueryWorkService($this->_talentWorkExperienceRepository());
        $jobHistoryDTO = $service->showById($jobHistoryId, $this->_getSessionId());
        $this->view->jobHistoryDTO = $jobHistoryDTO;        
        Tag::displayTo('id',$jobHistoryDTO->id());
        Tag::displayTo('companyName',$jobHistoryDTO->companyName());
        Tag::displayTo('position',$jobHistoryDTO->position());
        Tag::displayTo('startYear',$jobHistoryDTO->startWorkingTime());
        Tag::displayTo('endYear',$jobHistoryDTO->endWorkingTime());
        Tag::displayTo('role',$jobHistoryDTO->role());
    }
    public function updateJobAction(){
        if(!$this->request->isPost()){return $this->forward('talent/job');}
        $id = strip_tags($this->request->getPost('id'));
        $companyName = strip_tags($this->request->getPost('companyName'));
        $position = strip_tags($this->request->getPost('position'));
        $startWorkingTime = strip_tags($this->request->getPost('startYear'));        
        $endWorkingTime = strip_tags($this->request->getPost('endYear'));
        $role = strip_tags($this->request->getPost('role'));
        $request = CommandWorkDTO::updateRequest($id, $companyName, $position, $startWorkingTime, $endWorkingTime, $role);
        $service = new CommandWorkService($this->_talentWorkExperienceRepository());
        try {
            $service->update($request, $this->_getSessionId());
            $this->flash->success("Job History Updated");
        } catch (JobHistoryNotFoundException $ex) {
            $this->flash->error("Fail to Update Job History ");
        }
        return $this->forward('talent/job');
    }
    public function removeJobAction($jobHistoryId){
        $service  = new CommandWorkService($this->_talentWorkExperienceRepository());
        try {
            $service->remove($jobHistoryId, $this->_getSessionId());
            $this->flash->success("Job History Removed");
        } catch (JobHistoryNotFoundException $ex) {
            $this->flash->error("Fail to Remove Job History ");
        }
        return $this->forward("talent/job");
    }
    /*
     * Certificate 
     */
    public function certificateAction(){   
        $service  = new QueryCertificateOwnedService($this->_talentCertificateCollectionRepository());
        $certificateDTOs = $service->showAll($this->_getSessionId());
        $this->view->certificateDTOs = $certificateDTOs;
    }
    public function addCertificateAction(){}
    public function saveCertificateAction(){
        if(!$this->request->isPost()){return $this->forward('talent/certificate');}
        $name = strip_tags($this->request->getPost('name'));
        $organizer = strip_tags($this->request->getPost('organizer'));
        $validUntil = strip_tags($this->request->getPost('validUntil'));
        $request = CommandCertificateDTO::addRequest($name, $organizer, $validUntil);
        $service = new CommandCertificateService($this->_talentCertificateCollectionRepository());
        try{
            $service->add($request, $this->_getSessionId());
            $this->flash->success("Certificate Added");
        } catch (CertificateNotFoundException $e){
            $this->flash->error('Fail Add Certificate  '+ $e);
        }
        return $this->forward('talent/certificate');
    }
    public function editCertificateAction($certificateOwnedId){
        $service  = new QueryCertificateOwnedService($this->_talentCertificateCollectionRepository()); 
        $certificateDTO = $service->showById($certificateOwnedId, $this->_getSessionId());
        //$this->view->certificateDTO = $certificateDTO;
        Tag::displayTo('id',$certificateDTO->id());
        Tag::displayTo('name',$certificateDTO->name());
        Tag::displayTo('organizer',$certificateDTO->organizer());
        Tag::displayTo('validUntil',$certificateDTO->validUntil());        
    }
    public function updateCertificateAction(){
        if(!$this->request->isPost()){return $this->forward('talent/certificate');}        
        $id = strip_tags($this->request->getPost('id'));
        $name = strip_tags($this->request->getPost('name'));
        $organizer = strip_tags($this->request->getPost('organizer'));
        $validUntil = strip_tags($this->request->getPost('validUntil'));
        $request = CommandCertificateDTO::updateRequest($id, $name, $organizer, $validUntil);
        $service = new CommandCertificateService($this->_talentCertificateCollectionRepository());
        try {
            $service->update($request, $this->_getSessionId());
            $this->flash->success("Certificate Updated");
        } catch (CertificateOwnedNotFoundException $ex) {
            $this->flash->error("Update Failed ");
        }
        return $this->forward("talent/certificate");
    }
    public function removeCertificateAction($certificateOwnedId){
        $service = new CommandCertificateService($this->_talentCertificateCollectionRepository());
        try {
            $service->remove($certificateOwnedId, $this->_getSessionId());
            $this->flash->success("Certificate Removed");
        } catch (CertificateOwnedNotFoundException $ex) {
            $this->flash->error("Failed to Remove Certificate ");
        }
        return $this->forward("talent/certificate");
    }
     /*
     * Skill
     */
    public function skillAction(){   
        $service = new QueryTalentSkillService($this->_talentSkillSetRepository(), $this->_externalSkillFinderHelper());
        $skillSetDTOs = $service->showAll($this->_getSessionId());
        $this->view->skillSetDTOs = $skillSetDTOs;
    }
    public function addSkillAction(){
        $this->view->skillDTOs = $this->_externalSkillFinderHelper()->getAllQuerySkillDTO();
    }
    public function saveSkillAction(){
        if(!$this->request->isPost()){return $this->forward('talent/skill');}
        $score = strip_tags($this->request->getPost('score'));
        $referenceSkillId = strip_tags($this->request->getPost('referenceSkillId'));
        $request = CommandTalentSkillDTO::addRequest($score, $referenceSkillId);
        $service = new CommandTalentSkillService($this->_talentSkillSetRepository(), $this->_externalSkillFinderHelper());
        try {
            $service->add($request, $this->_getSessionId());
            $this->flash->success('Skill Set Added');
        } catch (DuplicateSkillException $ex) {
            $this->flash->error('Fail to Add Skillset ');
        }
        return $this->forward('talent/skill');
    }
    public function editSkillAction($skillSetId){   
            $this->view->skillDTOs = $this->_externalSkillFinderHelper()->getAllQuerySkillDTO();
            $service = new QueryTalentSkillService($this->_talentSkillSetRepository(), $this->_externalSkillFinderHelper());
            $skillSetDTO = $service->ShowById($skillSetId, $this->_getSessionId());
            $this->view->skillSetDTO = $skillSetDTO;
            Tag::displayTo('id',$skillSetDTO->id());
            Tag::displayTo('score',$skillSetDTO->score());
            Tag::displayTo('referenceSkillId',$skillSetDTO->querySkillDTO()->name());
            var_dump($skillSetDTO);
    }

    public function updateSkillAction(){
        if(!$this->request->isPost()){
            return $this->forward('talent/skill');
        }
        $id = strip_tags($this->request->getPost('id'));
        $score = strip_tags($this->request->getPost('score'));
        $referenceSkillDTO = strip_tags($this->request->getPost('referenceSkillId'));
        
        $request = CommandTalentSkillDTO::updateRequest($id, $score, $referenceSkillDTO);
        $service = new CommandTalentSkillService($this->_talentSkillSetRepository(), $this->_externalSkillFinderHelper());
        
        try {
            $service->update($request, $this->_getSessionId());
            $this->flash->success('Skillset Updated');
        } catch (DuplicateSkillException $ex) {
            $this->flash->error('Fail to Update Skill ');
        }
        return $this->forward('talent/skill');
    }
    public function removeSkillAction($talentSkillId){
        $service = new RemoveTalentSkillService($this->_talentSkillSetRepository());
        try {
            $service->execute($talentSkillId, $this->_getSessionId());
            $this->flash->success("Skill Removed");
        } catch (TalentSkillNotFoundException $ex) {
            $this->flash->error("Failed to Remove Skill");
        }
        return $this->forward("talent/skill");
    }
    /*
     * Training History
     */
    public function trainingAction(){ 
        $service = new QueryTrainingService($this->_talentTrainingHistoryRepository());
        $trainingHistoryDTOs = $service->ShowAll($this->_getSessionId());
        $this->view->trainingHistoryDTOs = $trainingHistoryDTOs;   
    }
    public function addTrainingAction(){}
    public function saveTrainingAction(){
        if(!$this->request->isPost()){
            return $this->forward('talent/training');
        }
        $name = strip_tags($this->request->getPost('name'));
        $organizer = strip_tags($this->request->getPost('organizer'));
        $year = strip_tags($this->request->getPost('year'));
        $request = CommandTrainingDTO::addRequest($name, $organizer, $year);
        $service = new CommandTrainingService($this->_talentTrainingHistoryRepository());
        try {
            $service->add($request, $this->_getSessionId());
            $this->flash->success('Training Experience Added');
        } catch (TrainingNotFoundException $ex) {
            $this->flash->error('Fail to Add Training Experience ');
        }
        return $this->forward('talent/training');
    }
    public function editTrainingAction($trainingHistoryId){
        $service = new QueryTrainingService($this->_talentTrainingHistoryRepository());
        $trainingHistoryDTO = $service->showById($trainingHistoryId, $this->_getSessionId());
        $this->view->trainingHistoryDTO = $trainingHistoryDTO;
        Tag::displayTo('id',$trainingHistoryDTO->id());
        Tag::displayTo('name',$trainingHistoryDTO->name());
        Tag::displayTo('organizer',$trainingHistoryDTO->organizer());
        Tag::displayTo('year',$trainingHistoryDTO->year());
    }
    public function updateTrainingAction(){
        if(!$this->request->isPost()){return $this->forward('talent/training');}
        $id = strip_tags($this->request->getPost('id'));
        $name = strip_tags($this->request->getPost('name'));
        $organizer = strip_tags($this->request->getPost('organizer'));
        $year = strip_tags($this->request->getPost('year'));
        
        $request = CommandTrainingDTO::updateRequest($id, $name, $organizer, $year);
        $service  = new CommandTrainingService($this->_talentTrainingHistoryRepository());
        
        try {
            $service->update($request, $this->_getSessionId());
            $this->flash->success('Training History Updated');
        } catch (TrainingHistoryNotFoundException $ex) {
            $this->flash->error('Fail to Update Training History ');
        }
        return $this->forward('talent/training');
    }
    public function removeTrainingAction($trainingHistoryId){
        $service = new CommandTrainingService($this->_talentTrainingHistoryRepository());
        try {
            $service->remove($trainingHistoryId, $this->_getSessionId());
            $this->flash->success('Talent History Deleted');
        } catch (TrainingHistoryNotFoundException $ex) {
            $this->flash->error('Fail to delete Training History ');
        }
        return $this->forward('talent/training');
    }
	
	/*
     * Repository
     */
	 
	public function dashboardAction(){
		
	}
   
    /*
     * Repository
     */
    protected function _getSessionId(){
        return $this->session->get('auth')['id'];
    }
    protected function _getTalentRepository(){
        return $this->em->getRepository('Talent\Domain\Model\Profile\TalentProfile');
    }
    protected function _talentEducationRepository(){
        return $this->em->getRepository('Talent\Domain\Model\Education\TalentEducationHistory');
    }
    protected function _talentWorkExperienceRepository(){
        return $this->em->getRepository('Talent\Domain\Model\Work\TalentWorkExperience');
    }
    protected function _talentTrainingHistoryRepository(){
        return $this->em->getRepository('\Talent\Domain\Model\Training\TalentTrainingHistory');
    }
    protected function _talentSkillSetRepository(){
        return $this->em->getRepository('Talent\Domain\Model\Skill\TalentSkillSet');
    }
    protected function _talentCertificateCollectionRepository(){
        return $this->em->getRepository('\Talent\Domain\Model\Certificate\TalentCertificateCollection');
    }
    protected function _internalPersonnelFinderHelper(){
        $personnelRepository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        return new Managerial\Application\Service\Personnel\Helper\InternalPersonnelFinderHelper($personnelRepository);
    }
    protected function _externalCityFinderHelper(){
        return new ExternalCityFinderHelper($this->em->getRepository('\Managerial\Domain\Model\City\City'));
    }
    protected function _externalTrackFinderHelper(){
        return new ExternalTrackFinderHelper($this->em->getRepository('Managerial\Domain\Model\Track\Track'));
    }
    protected function _externalSkillFinderHelper(){
        $skillRepository = $this->em->getRepository('Managerial\Domain\Model\Skill\Skill');
        return new Managerial\Application\Service\Skill\Helper\ExternalSkillFInderHelper($skillRepository);
    }
}


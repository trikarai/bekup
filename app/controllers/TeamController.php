<?php
use Phalcon\Tag;
use Talent\Application\Service\Team\DTO\QueryTeamDTO;
use Talent\Application\Service\Team\QueryTeamService;
use Talent\Application\Service\AsTeamMember\QueryTalentAsTeamMemberService;
use Talent\Application\Service\AsTeamMember\CreateTeamService;
use Talent\Domain\Model\AsTeamMember\Exception\DuplicateTeamNameException;

use Resources\Helper\FileUploader;

use Talent\Application\Service\Training\QueryTrainingService;
use Talent\Application\Service\Education\QueryEducationService;
use Talent\Application\Service\Certificate\QueryCertificateOwnedService;
use Talent\Application\Service\Skill\QueryTalentSkillService;

use Talent\Application\Service\Team\DTO\CommandTeamDTO;

use Talent\Application\Service\TalentProfile\QueryTalentService;
use Managerial\Application\Service\City\Helper\ExternalCityFinderHelper;
use Managerial\Application\Service\Track\Helper\ExternalTrackFinderHelper;

class TeamController extends TalentControllerBase{
		
    public function indexAction(){
         if(!$this->_getSessionId()){
			 $this->view->reset();
                         $this->flash->error('seesion expired ');
			 return $this->forward('login');
		 }
        $service = new QueryTeamService($this->_talentAsTeamMemberRepository());
        $hasActiveTeam = $service->hasActiveTeam($this->_getSessionId());
                
        if(!$hasActiveTeam){
            $this->forward('team/dashboardTeam');
        }else{
//            $this->view->teamActiveDTO = $teamActiveDTO;
            $this->forward('team/activeTeam');
        }       
    }
    public function dashboardTeamAction(){
        
    }
    public function activeTeamAction(){
        $service = new QueryTeamService($this->_talentAsTeamMemberRepository());
        $teamActiveDTO = $service->showActiveTeam($this->_getSessionId());
        $this->view->teamActiveDTO = $teamActiveDTO;
        $this->view->myId = $this->_getSessionId();
        
        
        
//        $teamActiveDTO->queryActiveTeamMemberDTOs()[]->queryTalentAsTeamMemberProfileDTO()->name();
        
        $invitedDTOs = $service->showInvitedTalent($this->_getSessionId());
        $this->view->invitedDTOs = $invitedDTOs;
        
//        $invitedDTOs->queryTalentAsTeamMemberProfileDTO()->name();
//        $invitedDTOs->queryTalentAsTeamMemberProfileDTO()->id();
//        $invitedDTOs->id();
        
    }
    public function createTeamAction(){
    }
    public function saveTeamAction(){
        if(!$this->request->isPost()){$this->forward('team/createTeam');}
        $name = strip_tags($this->request->getPost("name"));
        $vision = strip_tags($this->request->getPost("vision"));
        $mission = strip_tags($this->request->getPost("mission"));
        $culture = strip_tags($this->request->getPost("culture"));
        $position = strip_tags($this->request->getPost("position"));      
//        $targetDir = "../../public/uploads/";
//        $targetDir = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR;
        $targetDir = BASE_PATH . "/public/uploads/";  
        $upload = $this->request->getUploadedFiles()[0];
        $isUploaded = false;
        
        if($_FILES["founderAgreementFile"]["error"] == 4) { 
    
        }else{
            $upload = $this->request->getUploadedFiles()[0];
            
            if($upload->getRealType()!="application/pdf" && $upload->getRealType()!="application/msword" && $upload->getRealType() !="application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
                $this->forward('team/editTeam');
                $this->flash->warning('File Must be PDF / DOC / DOCX');
                return;
            } else if($upload->getSize()>100000){
                $this->forward('team/editTeam');
                $this->flash->warning('File must not more than 1 MB');
                return;
            }
            
            $fileName = md5(uniqid(mt_rand(),true)).'-'.$upload->getName();
            $path = $targetDir.$fileName;
            ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
        }
        
        $fileName = md5(uniqid(mt_rand(),true)).'-'.$upload->getName();
        $path = $targetDir.$fileName;
        ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
 
        if($isUploaded){
            $founderAgreement = $fileName;
        }else{
            $founderAgreement = "";
        }
        
        $request = CommandTeamDTO::addRequest($name, $vision, $mission, $culture, $founderAgreement, $position);
        $service = new CreateTeamService($this->_talentAsTeamMemberRepository(), $this->_teamRepository());
        
        try {
            $service->execute($request, $this->_getSessionId());
            $this->flash->success('Team Created');
            return $this->forward('team/activeTeam');
        } catch (DuplicateTeamNameException $ex) {
            $this->flash->error('Failed To Create Team (Team Name Already Exist)');
            return $this->forward('team/createTeam');
        }
        
    }
    public function editTeamAction(){
        $service = new QueryTeamService($this->_talentAsTeamMemberRepository());
        $teamActiveDTO = $service->showActiveTeam($this->_getSessionId());
        $this->view->teamActiveDTO = $teamActiveDTO;
        Tag::displayTo('name',$teamActiveDTO->name());
        Tag::displayTo('mission', $teamActiveDTO->mission());
        Tag::displayTo('vision',$teamActiveDTO->vision());
        Tag::displayTo('culture',$teamActiveDTO->culture());
        Tag::displayTo('position',$teamActiveDTO->queryActiveTeamMemberDTOs()[0]->position());
        
        $this->view->fileactive = $teamActiveDTO->founderAgreement();
        
    }
    public function updateTeamAction(){
        if(!$this->request->isPost()){$this->forward('team/editTeam');}
        $name = strip_tags($this->request->getPost("name"));
        $vision = strip_tags($this->request->getPost("vision"));
        $mission = strip_tags($this->request->getPost("mission"));
        $culture = strip_tags($this->request->getPost("culture"));
        //$founderAgreement = strip_tags($this->request->getPost("founderAgreement"));
        $position = strip_tags($this->request->getPost("position"));
         
        $targetDir = BASE_PATH . "/public/uploads/";  
        $isUploaded = false;
        
        if($_FILES["founderAgreementFile"]["error"] == 4) {   
        }else{
            $upload = $this->request->getUploadedFiles()[0];
            
            if($upload->getRealType()!="application/pdf" && $upload->getRealType()!="application/msword" && $upload->getRealType() !="application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
                $this->forward('team/editTeam');
                $this->flash->warning('File Must be PDF / DOC / DOCX');
                return;
            } else if($upload->getSize()>100000){
                $this->forward('team/editTeam');
                $this->flash->warning('File must not more than 1 MB');
                return;
            }
            
            $fileName = md5(uniqid(mt_rand(),true)).'-'.$upload->getName();
            $path = $targetDir.$fileName;
            ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
            
        }
          
        if($isUploaded){
            $founderAgreement = $fileName;
        }else{
            $founderAgreement = strip_tags($this->request->getPost("founderAgreementFile2"));;
        }
        
        $request = CommandTeamDTO::updateRequest($name, $vision, $mission, $culture, $founderAgreement, $position);
        $service = new Talent\Application\Service\Team\CommandTeamService($this->_teamRepository(), $this->_internalTalentAsTeamMemberFinderHelper());
        
        try {
            $service->update($request, $this->_getSessionId());
            $this->flash->success('Team Updated');
            return $this->forward('team/activeTeam');
        } catch (DuplicateTeamNameException $ex) {
            $this->flash->error('Failed To Create Team (Team Name Already Exist)');
            return $this->forward('team/editTeam');
        }
    }
        public function  notificationAction(){
        $service = new QueryTalentAsTeamMemberService($this->_talentAsTeamMemberRepository());
        $notificationDTOs = $service->showInvitingTeam($this->_getSessionId());
        $this->view->notificationDTOs = $notificationDTOs;
        
        $service2 = new QueryTeamService($this->_talentAsTeamMemberRepository());
        $hasActive = $service2->hasActiveTeam($this->_getSessionId());
        $this->view->hasActive = $hasActive;      
        
    }
    public function acceptInvitationAction($memberIdString){
        $service = new \Talent\Application\Service\AsTeamMember\CommandMemberService($this->_talentAsTeamMemberRepository());
        $service->acceptInvitation($memberIdString, $this->_getSessionId());
        $this->flash->success('Invitation Accepted');
        $this->forward('team/index');
    }
    public function rejectInvitationAction($memberIdString){
        $service = new \Talent\Application\Service\AsTeamMember\CommandMemberService($this->_talentAsTeamMemberRepository());
        $service->refuseInvitation($memberIdString, $this->_getSessionId());
        $this->flash->success('Invitation Rejected');
        $this->forward('team/index');
    }
    public function resignTeamAction($memberIdString){
        $service = new \Talent\Application\Service\AsTeamMember\CommandMemberService($this->_talentAsTeamMemberRepository());
        $service->resign($memberIdString, $this->_getSessionId());
        $this->flash->success('You are resigned');
        $this->forward('team/index');
    }
    public function kickMemberAction($memberIdString){
        $service = new Talent\Application\Service\Team\CommandTeamService($this->_teamRepository(), $this->_internalTalentAsTeamMemberFinderHelper());
        $service->requestForDropMember($memberIdString, $this->_getSessionId());
        $this->flash->success('Member Kicked');
        $this->forward('team/index');
    }
    public function inviteMemberAction(){
        $service = new QueryTeamService($this->_talentAsTeamMemberRepository());
        $availableTalentDTOs = $service->showAvailableTalent($this->_getSessionId());
        $this->view->availableTalentDTOs = $availableTalentDTOs;
    }
    public function inviteTalentAction($talentId){
        $serviceTalent = new QueryTalentService($this->_getTalentRepository(),$this->_externalCityFinderHelper(), $this->_externalTrackFinderHelper());
        $talentDTO = $serviceTalent->execute($talentId);
        $this->view->talentDTO = $talentDTO;
        $this->view->talentId = $talentId;
        
        $serviceWork = new Talent\Application\Service\Work\QueryWorkService($this->_talentWorkExperienceRepository());
        $jobHistoryDTOS = $serviceWork->showAll($talentId);
        $this->view->jobHistoryDTOs = $jobHistoryDTOS; 
        
        $serviceTraining = new QueryTrainingService($this->_talentTrainingHistoryRepository());
        $trainingHistoryDTOs = $serviceTraining->ShowAll($talentId);
        $this->view->trainingHistoryDTOs = $trainingHistoryDTOs;  
        
        $serviceEducation = new QueryEducationService($this->_talentEducationRepository());
        $educationHistoryDTOs = $serviceEducation->showAll($talentId);
        $this->view->educationHistoryDTOs = $educationHistoryDTOs;
        
        $serviceCertificate  = new QueryCertificateOwnedService($this->_talentCertificateCollectionRepository());
        $certificateDTOs = $serviceCertificate->showAll($talentId);
        $this->view->certificateDTOs = $certificateDTOs;
        
        $serviceSkill = new QueryTalentSkillService($this->_talentSkillSetRepository(), $this->_externalSkillFinderHelper());
        $skillSetDTOs = $serviceSkill->showAll($talentId);
        $this->view->skillSetDTOs = $skillSetDTOs;
    }
    public function cancelInvitationAction($membershipIdString){
        $service = new Talent\Application\Service\Team\CommandTeamService($this->_teamRepository(), $this->_internalTalentAsTeamMemberFinderHelper());
        $service->cancelInvitation($membershipIdString, $this->_getSessionId());
        $this->flash->success('Member Invite Canceled');
        $this->forward('team/index');
    }
    public function sendInvitationAction($invitedTalentIdString){
        $service = new Talent\Application\Service\Team\CommandTeamService($this->_teamRepository(), $this->_internalTalentAsTeamMemberFinderHelper());
        //$positionString = 'Undefined';
        $positionString = strip_tags($this->request->getPost("position"));
        try {
            $service->inviteMember($invitedTalentIdString, $positionString, $this->_getSessionId());
            $this->flash->success('ok');
            return $this->forward('team/inviteMember');
        } catch (Talent\Domain\Model\Team\Exception\DuplicateTalentInvitationException $ex) {
            $this->flash->error('error invite');
            return $this->forward('team/inviteMember');
        }
        
    }
    

    public function profileTeamAction($teamId){
        
    }
    public function profileTalentAction($talentId){
        $serviceTalent = new QueryTalentService($this->_getTalentRepository(),$this->_externalCityFinderHelper(), $this->_externalTrackFinderHelper());
        $talentDTO = $serviceTalent->execute($talentId);
        $this->view->talentDTO = $talentDTO;
        $this->view->talentId = $talentId;
        
        $serviceWork = new Talent\Application\Service\Work\QueryWorkService($this->_talentWorkExperienceRepository());
        $jobHistoryDTOS = $serviceWork->showAll($talentId);
        $this->view->jobHistoryDTOs = $jobHistoryDTOS; 
        
        $serviceTraining = new QueryTrainingService($this->_talentTrainingHistoryRepository());
        $trainingHistoryDTOs = $serviceTraining->ShowAll($talentId);
        $this->view->trainingHistoryDTOs = $trainingHistoryDTOs;  
        
        $serviceEducation = new QueryEducationService($this->_talentEducationRepository());
        $educationHistoryDTOs = $serviceEducation->showAll($talentId);
        $this->view->educationHistoryDTOs = $educationHistoryDTOs;
        
        $serviceCertificate  = new QueryCertificateOwnedService($this->_talentCertificateCollectionRepository());
        $certificateDTOs = $serviceCertificate->showAll($talentId);
        $this->view->certificateDTOs = $certificateDTOs;
        
        $serviceSkill = new QueryTalentSkillService($this->_talentSkillSetRepository(), $this->_externalSkillFinderHelper());
        $skillSetDTOs = $serviceSkill->showAll($talentId);
        $this->view->skillSetDTOs = $skillSetDTOs;
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
    protected function _externalCityFinderHelper(){
        return new ExternalCityFinderHelper($this->em->getRepository('\Managerial\Domain\Model\City\City'));
    }
    protected function _externalTrackFinderHelper(){
        return new ExternalTrackFinderHelper($this->em->getRepository('Managerial\Domain\Model\Track\Track'));
    }
    protected function _talentWorkExperienceRepository(){
        return $this->em->getRepository('Talent\Domain\Model\Work\TalentWorkExperience');
    }
    
    protected function _talentAsTeamMemberRepository(){
        return $this->em->getRepository('Talent\Domain\Model\AsTeamMember\TalentAsTeamMember');
    }
    protected function _teamRepository(){
        return $this->em->getRepository('Talent\Domain\Model\Team\Team');
    }
    protected function _internalTalentAsTeamMemberFinderHelper(){
        return new Talent\Application\Service\AsTeamMember\Helper\InternalTalentAsTeamMemberFinderHelper($this->_talentAsTeamMemberRepository());
    }
    protected function _talentTrainingHistoryRepository(){
        return $this->em->getRepository('\Talent\Domain\Model\Training\TalentTrainingHistory');
    }
    protected function _talentEducationRepository(){
        return $this->em->getRepository('Talent\Domain\Model\Education\TalentEducationHistory');
    }
    protected function _talentSkillSetRepository(){
        return $this->em->getRepository('Talent\Domain\Model\Skill\TalentSkillSet');
    }
    protected function _talentCertificateCollectionRepository(){
        return $this->em->getRepository('\Talent\Domain\Model\Certificate\TalentCertificateCollection');
    }
    protected function _externalSkillFinderHelper(){
        $skillRepository = $this->em->getRepository('Managerial\Domain\Model\Skill\Skill');
        return new Managerial\Application\Service\Skill\Helper\ExternalSkillFInderHelper($skillRepository);
    }
}
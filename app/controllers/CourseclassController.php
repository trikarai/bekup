<?php
use Phalcon\Tag;

use Managerial\Application\Service\Personnel\Helper\InternalPersonnelFinderHelper;
use Managerial\Application\Service\CourseClass\DTO\CommandCourseClassDTO;

use Managerial\Application\Service\CourseClass\CommandCourseClassService;
use Managerial\Application\Service\CourseClass\CommandCourseClassServicePropagateVersion;
use Managerial\Application\Service\CourseClass\QueryCourseClassService;
use Managerial\Domain\Model\CourseClass\Exception\DuplicateCourseClassName;

class CourseClassController extends ControllerBase{
    function indexAction($courseIdString){
        $service = $this->_getQueryCourseClassService();
        
        $subjectCourseDTOs = $service->showAll($courseIdString, $this->_getSessionId());
        $this->view->subjectCourseDTOs = $subjectCourseDTOs;
        $this->view->subjectId = $courseIdString;
    }
    
    function newAction($subjectId){
        Tag::displayTo('subject_id', $subjectId);
    }
    
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forward('course/index');
        }
        $request = $this->_getCommandCourseClassDTO('add');
        $service = $this->_getCommandCourseClassService();
        try{
            $service->add($request, $this->_getSessionId());
            $this->flash->success('subject course created');
        } catch(DuplicateCourseClassName $e){
            $this->flash->error('Course Class Name already used');
        }
        return $this->forward('course/index');
    }
    
    function editAction($courseClassIdString, $courseIdString){
        $service = $this->_getQueryCourseClassService();
        $QueryCourseClassDTO = $service->showById($courseClassIdString, $courseIdString, $this->_getSessionId());
        $this->view->subjectCourseDTO = $QueryCourseClassDTO;
        
        Tag::displayTo("id",$QueryCourseClassDTO->id());
        Tag::displayTo("subject_id",$courseIdString);
        Tag::displayTo("name",$QueryCourseClassDTO->name());
        Tag::displayTo("start_registration_date",$QueryCourseClassDTO->startRegistrationDate());
        Tag::displayTo("end_registration_date",$QueryCourseClassDTO->endRegistrationDate());
        Tag::displayTo("start_operational_date",$QueryCourseClassDTO->startOperationalDate());
        Tag::displayTo("end_operational_date",$QueryCourseClassDTO->endOperationalDate());
    }
    
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('course/index');
        }
        $request = $this->_getCommandCourseClassDTO('update');
        $service = $this->_getCommandCourseClassService();
        try{
            $service->update($request, $this->_getSessionId());
            $this->flash->success('Course Class updated');
        } catch(DuplicateSubjectCourseNameException $e){
            $this->flash->error('Course Class Name already used');
        }
        return $this->forward('course/index');
    }
    
    function removeAction($courseClassIdString, $courseIdString){
        $request = CommandCourseClassDTO::removeRequest($courseClassIdString, $courseIdString);
        //$request = $this->_getCommandCourseClassDTO('remove');
        $service = $this->_getCommandCourseClassService();
        $service->remove($request, $this->_getSessionId());
        $this->flash->success('Course Class removed');
        return $this->forward('course/index');
    }
    
    protected function _getCommandCourseClassDTO($requestType){
        $courseId = strip_tags($this->request->getPost('subject_id'));
        if($requestType === 'remove'){
            $id = strip_tags($this->request->getPost('id'));
            return CommandCourseClassDTO::removeRequest($id, $courseId);
        }
        $name = strip_tags($this->request->getPost('name'));
        $startRegistrationDate = strip_tags($this->request->getPost('start_registration_date'));
        $endRegistrationDate = strip_tags($this->request->getPost('end_registration_date'));
        $startOperationalDate = strip_tags($this->request->getPost('start_operational_date'));
        $endOperationalDate = strip_tags($this->request->getPost('end_operational_date'));
        if($requestType === 'add'){
            return CommandCourseClassDTO::addRequest($name, $startRegistrationDate, $endRegistrationDate, $startOperationalDate, $endOperationalDate, $courseId);
        } else if($requestType === 'update'){
            $id = strip_tags($this->request->getPost('id'));
            return CommandCourseClassDTO::updateRequest($id, $name, $startRegistrationDate, $endRegistrationDate, $startOperationalDate, $endOperationalDate, $courseId);
        }
    }
    
    /**
     * @return CommandCourseClassService
     */
    protected function _getCommandCourseClassService(){
        $courseRepository = $this->em->getRepository('Managerial\Domain\Model\Course\Course');
        $cityRepository = $this->em->getRepository('Managerial\Domain\Model\City\City');
        return new CommandCourseClassServicePropagateVersion($courseRepository, $this->_getInternalPersonnelFinderHelper(), $cityRepository);
//        return new CommandCourseClassService($courseRepository, $this->_getInternalPersonnelFinderHelper());
    }
    protected function _getQueryCourseClassService(){
        $courseClassRepository = $this->em->getRepository('\Managerial\Domain\Model\CourseClass\CourseClass');
        return new QueryCourseClassService($courseClassRepository, $this->_getInternalPersonnelFinderHelper());
    }
    protected function _getInternalPersonnelFinderHelper(){
        $personnelRepository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        return new InternalPersonnelFinderHelper($personnelRepository);
    }
    protected function _getSessionId(){
        return $this->session->get('auth')['id'];
    }
}

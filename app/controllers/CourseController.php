<?php
use Phalcon\Tag;

use Managerial\Application\Service\Course\DTO\CommandCourseDTO;
use Managerial\Application\Service\Course\CommandCourseService;
use Managerial\Application\Service\Course\QueryCourseService;
use Managerial\Application\Service\Personnel\Helper\InternalPersonnelFinderHelper;
use Managerial\Domain\Model\Course\Exception\DuplicateCourseNameException;

class CourseController extends ControllerBase{
    function indexAction(){
        $courseDTOs = $this->_getQueryCourseService()->showAll($this->_getSessionId());
        $this->view->courseDTOs = $courseDTOs;
    }
    function newAction(){
        Tag::displayTo('name', $this->request->getPost('name'));
    }
    function addAction(){
        if(!$this->request->isPost()){
            return $this->forward('course/index');
        }
        $name = strip_tags($this->request->getPost('name'));
        $request = CommandCourseDTO::addRequest($name);
        $service = $this->_getCommandCourseService();
        try{
            $service->add($request, $this->_getSessionId());
            $this->flash->success('Course Created');
            return $this->forward('course/index');
        } catch(DuplicateCourseNameException $e){
            $this->flash->error('Course Name Already Used');
            return $this->forward('course/new');
        }
    }
    function editAction($courseId){
        $courseDTO = $this->_getQueryCourseService()->showById(strip_tags($courseId), $this->_getSessionId());
        Tag::displayTo('id',$courseDTO->id());
        Tag::displayTo('name',$courseDTO->name());
    }
    function updateAction(){
        if(!$this->request->isPost()){
            return $this->forward('course/index');
        }
        $id = strip_tags($this->request->getPost('id'));
        $name = strip_tags($this->request->getPost('name'));
        $request = CommandCourseDTO::updateRequest($id, $name);
        $service = $this->_getCommandCourseService();
        try{
            $service->update($request, $this->_getSessionId());
            $this->flash->success('Course updated');
        } catch(DuplicateCourseNameException $e){
            $this->flash->error('Course Name already Used');
        }
        return $this->forward('course/index');
    }
    function removeAction($courseId){
        $service = $this->_getCommandCourseService();
        $service->remove(strip_tags($courseId), $this->_getSessionId());
        $this->flash->success('Course Removed');
        return $this->forward('course/index');
    }
    
    /**
     * @return CommandCourseService
     */
    protected function _getCommandCourseService(){
        $trackRepository = $this->em->getRepository('Managerial\Domain\Model\Track\Track');
        return new CommandCourseService($trackRepository, $this->_getInternalPersonnelFinderHelper());
    }
    /**
     * @return QueryCourseService
     */
    protected function _getQueryCourseService(){
        $courseRepository = $this->em->getRepository('Managerial\Domain\Model\Course\Course');
        return new QueryCourseService($courseRepository, $this->_getInternalPersonnelFinderHelper());
    }
    protected function _getInternalPersonnelFinderHelper(){
        $personnelRepository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        return new InternalPersonnelFinderHelper($personnelRepository);
    }
    protected function _getSessionId(){
        return $this->session->get('auth')['id'];
    }
}
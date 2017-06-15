<?php
/**
 * Description of PersonelController
 *
 * @author Inandar Wiguna
 */
use Managerial\Application\Service\Personnel\PersonnelDTO;
use Managerial\Application\Service\Personnel\AddPersonnelService;
use Managerial\Application\Service\Personnel\UpdatePersonnelService;
use Managerial\Application\Service\Personnel\ShowPersonnelService;
use Managerial\Application\Service\Personnel\RemovePersonnelService;

class PersonnelController extends ControllerBase {
    
    public function indexAction(){
        $repository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        $service = new ShowPersonnelService($repository);
        $personnelDTOs = $service->showAll($this->session->get('auth')['id']);
        $this->view->personnelDTOs = $personnelDTOs;
    }
    
    public function addAction(){
        
    }
    
    public function saveAction(){
        if(!$this->request->isPost()){
            return $this->forward('Personnel/Index');
        }

        //get parameter data from FORM
        $name = $this->request->get('name');
        $email = $this->request->get('email');
        $password = $this->request->get('password');
        $role = $this->request->get('role');

        //Create Data Transfer Object 
        $request = PersonnelDTO::addRequest($name, $email, $password, $role);

        //Create Personnel Service Repository
        $personnelRepository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        $service = new AddPersonnelService($personnelRepository);
        try{
            $service->execute($request, $this->session->get('auth')['id']);
            $this->flash->success("Personnel Added");
        } catch(\Managerial\Domain\Model\Personnel\Exception\DuplicatePersonnelEmailException $e){
            $this->flash->error("Email already registered");
        }
        return $this->forward("Personnel/Index");
    }
    
    public function editAction($personnelId) {
        $repository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        $service = new ShowPersonnelService($repository);
        $personnelDTO = $service->showById($personnelId, $this->session->get('auth')['id']);
        $this->view->personnelDTO = $personnelDTO;
    }
    
    public function updateAction () {
        if(!$this->request->isPost()){
            return $this->forward('Personnel/Index');
        }
        
        $data = $this->request->getPost();
        print_r($data);
        
        $id = $this->request->get('id');
        $name = $this->request->get('name');
        $email = $this->request->get('email');
        $role = $this->request->get('role');
        $request = PersonnelDTO::updateRequest($id, $name, $email, $role);
        
        $repository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        $service = new UpdatePersonnelService($repository);
        $service->execute($request, $this->session->get('auth')['id']);
        $this->flash->success("Personnel Updated");
        return $this->forward("Personnel/Index");
    }
    
    public function removeAction($personnelId){
        $repository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        $service = new RemovePersonnelService($repository);
        $service->execute($personnelId, $this->session->get('auth')['id']);
        $this->flash->success("Personnel Removed");
        return $this->forward("Personnel/index");
    }
}
     

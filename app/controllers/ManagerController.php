<?php
use Phalcon\Tag as Tag;
use Phalcon\Filter;

use Personnel\ApplicationService\Personnel\LoginPersonnelService;
use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;

class ManagerController extends ControllerBase {
    public function indexAction(){
        if (!$this->request->isPost()) {
            Tag::setDefault('email', 'email');
            Tag::setDefault('password', 'password');
        }
        $this->view->rolebekup = $this->session->get('auth')['role'];
    }
        
    public function loginAction(){
        if(!$this->request->isPost()){
            return $this->forward("managerial/dashboard");
        }
        $filter = new Filter();
        $personnelRepository = $this->em->getRepository('\Personnel\DomainModel\Personnel\Personnel');
        $service = new LoginPersonnelService($personnelRepository);
        
        $email = $filter->sanitize($this->request->getPost('email'), 'email');
        $password = $this->request->getPost('password');
        
        $response = $service->execute($email, $password);
        if(false === $response->getStatus()){
            foreach($response->errorMessage()->getDetails() as $errorDetail){
                $this->flash->error($errorDetail);
            }
            return $this->forward('manager/index');
        }
        $this->_registerSession($response->firstReadDataObject());
        $this->flash->success('Welcome Bro' . ' ' . $response->firstReadDataObject()->getName() . ' as ' . $response->firstReadDataObject()->getRole());
        return $this->forward('managerial/dashboard');//forward to admin dashboard page
    }
    
    public function logoutAction() {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('manager/index');
    }
    
    /**
     * Register authenticated user into session data
     */
    private function _registerSession(PersonnelReadDataObject $personnelRdo)
    {
        $this->session->set('auth', array(
            'id' => $personnelRdo->getId(),
            'name' => $personnelRdo->getName(),
            'role' => $personnelRdo->getRole()
        ));
    }
}

<?php
use Phalcon\Tag as Tag;
use Phalcon\Filter;

use Managerial\Application\Service\Personnel\PersonnelLoginService;
use Managerial\Application\Service\Personnel\Exception\PersonnelNotFoundException;

class SessionController extends ControllerBase {
    public function indexAction(){
        if (!$this->request->isPost()) {
            Tag::setDefault('email', 'email');
            Tag::setDefault('password', 'password');
        }
    }
    
    /**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession($personnelData)
    {
        $this->session->set('auth', array(
            'id' => $personnelData->id(),
            'name' => $personnelData->name(),
        ));
    }
    
    public function loginAction(){
        if(!$this->request->isPost()){
            return $this->forward("Session/index");
        }
        $filter = new Filter();
        $repository = $this->em->getRepository('Managerial\Domain\Model\Personnel\Personnel');
        $service = new PersonnelLoginService($repository);
        $email = $filter->sanitize($this->request->getPost('email'), 'email');
        $password = $this->request->getPost('password');
        
        try{
            $personnelData = $service->execute($email, $password);
        } catch(PersonnelNotFoundException $e){
            $this->flash->error("Wrong Email/Password");
            return $this->forward('session/index');
        }
        
        if(!$personnelData){
            $this->flash->error("Wrong Email/Password");
            return $this->forward('session/index');
        }
        $this->_registerSession($personnelData);
        $this->flash->success('Welcome' . ' ' . $personnelData->name());
        return $this->forward('admin/index');//forward to admin dashboard page
    }
    public function logoutAction() {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
//        return $this->forward('CorporateAdministrator/index');
    }
}

<?php
use Phalcon\Tag;
use Phalcon\Filter;

use Talent\Profile\ApplicationService\Talent\LoginTalentService;
use Superclass\DomainModel\Talent\TalentReadDataObject;

class LoginController extends ControllerBase {
    public function indexAction(){
        if (!$this->request->isPost()) {
            Tag::setDefault('email', 'email');
            Tag::setDefault('password', 'password');
        }
    }
	
    //kebutuhan styling (bisa di hapus)
    public function coordinatorAction(){
       
    }
    
    /**
     * Register authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(TalentReadDataObject $talentRdo)
    {
        $this->session->set('auth', array(
            'id' => $talentRdo->getId(),
            'name' => $talentRdo->getName(),
            'role' => 'Talent',
        ));
    }
    
    public function loginAction(){
        if(!$this->request->isPost()){
            return $this->forward("login/index");
        }
        $talentRepository = $this->em->getRepository('Talent\Profile\DomainModel\Talent\Talent');
        $service = new LoginTalentService($talentRepository);
        
        $username = strip_tags($this->request->getPost('username'));
        $password = $this->request->getPost('password');
        $response = $service->execute($username, $password);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('login/index');
        }
        $this->_registerSession($talentRdo = $response->firstReadDataObject());
        $this->flash->success('Welcome' . ' ' . $talentRdo->getName());
        return $this->forward('talentdashboard/index');
    }
    
    public function logoutAction() {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('login/index');
    }
}

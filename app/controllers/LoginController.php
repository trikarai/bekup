<?php
use Phalcon\Tag;
use Phalcon\Filter;

use Talent\Profile\ApplicationService\Talent\LoginTalentDiloService;
use Superclass\DomainModel\Talent\TalentReadDataObject;
use Team\Profile\ApplicationService\Talent\QueryMembershipService;

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
        $talentRepository = $this->em->getRepository('\Team\Profile\DomainModel\Talent\Talent');
        $service = new QueryMembershipService($talentRepository);
        $teamInvitationCount = $service->showInvitationCount($talentRdo->getId());
        $this->session->set('auth', array(
            'id' => $talentRdo->getId(),
            'name' => $talentRdo->getName(),
            'role' => 'Talent',
            'invitation_count' => $teamInvitationCount,
        ));
    }
    
    public function loginAction(){
        if(!$this->request->isPost()){
            return $this->forward("login/index");
        }
        $talentRepository = $this->em->getRepository('Talent\Profile\DomainModel\Talent\Talent');
        $service = new LoginTalentDiloService($talentRepository);
        
        $username = strip_tags($this->request->getPost('username'));
        $password = $this->request->getPost('password');
        $jsonObjectResponse = $this->_getDiloLoginResponse(urlencode($username), urlencode($password));
        if("success" !== $jsonObjectResponse->message){
            $this->flash->error("invalid username/password");
            //return $this->forward('index/index');
            return $this->forward('login/index');
        }elseif($username !== $jsonObjectResponse->username){
            $this->flash->error("your dilo account has not activated, please check your email");
            return $this->forward('login/index');
		}
        $response = $service->execute($username);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('login/index');
        }
        $this->_registerSession($talentRdo = $response->firstReadDataObject());
        $this->flash->success('Welcome' . ' ' . $talentRdo->getName());
        return $this->forwardNamespace('Talent/dashboard/index');
    }
    
    public function logoutAction() {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');
        return $this->forward('login/index');
    }
    
    protected function _getDiloLoginResponse($userName, $password){
        $url = "http://dilo.id/index.php?option=com_hoicoiapi&task=login&username=$userName&pass=$password&token=asdarsessssdiher8b8^6vdtsutv$^%fhffvsgjd6$^%vyutdgfjsdfis";
        $jsonResponse = file_get_contents($url);
        $jsonObject = json_decode($jsonResponse);
        return $jsonObject;
    }
}

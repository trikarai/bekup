<?php

use Phalcon\Tag;

use City\Profile\ApplicationService\City\QueryCityService;
use Track\Definition\ApplicationService\Track\QueryTrackService;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;
use Talent\Profile\ApplicationService\Talent\SignUpTalentService;

class RegisterController extends ControllerBase{    
    
    public function indexAction() {
        $this->view->cityList = $this->_getCityList();
        $this->view->trackList = $this->_getTrackList();
    }

    public function RegisterAction() {
        if(!$this->request->isPost() || !$this->verifiedCaptcha()){
            return $this->forward('register/index');
        }
        
        $service = new SignUpTalentService($this->_talentRepository(), $this->_cityRdoRepository(), $this->_trackRdoRepository());
        $response = $service->execute($this->_getSignupRequest());
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return $this->forward('register/index');
        }
        $this->flash->success("sign up successfully");
        return $this->forward('login/index');
    }
	
    protected function verifiedCaptcha(){
return true;		

        $captcha = $this->request->getPost('g-recaptcha-response');
        if(!$captcha){
            $this->flash->error('Please input captcha');
            return false;
        } else {
            $secretKey = "6LfhvBYUAAAAAEbdOB7p1VD_rQS7QW_tmVPujCbV";
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha);
            if(json_decode($response)->success === true){
                return true;
            } else {
                $this->flash->error('Wrong captcha');
                return false;
            }
        }
    }
    
    function _talentRepository(){
        return $this->em->getRepository('Talent\Profile\DomainModel\Talent\Talent');
    }
    function _cityRdoRepository(){
        return $this->em->getRepository('\Superclass\DomainModel\City\CityReadDataObject');
    }
    function _trackRdoRepository(){
        return $this->em->getRepository('\Superclass\DomainModel\Track\TrackReadDataObject');
    }
    function _getCityList(){
        $service = new QueryCityService($this->_cityRdoRepository());
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $response->toArrayOfIdNameList();
    }
    function _getTrackList(){
        $service = new QueryTrackService($this->_trackRdoRepository());
        $response = $service->showAll();
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
        }
        return $response->toArrayOfIdNameList();
    }
    
    function _getSignupRequest(){
        $name = strip_tags($this->request->getPost('name'));
        $userName = strip_tags($this->request->getPost('user_name'));
        $email = strip_tags($this->request->getPost('email'));
        $password = strip_tags($this->request->getPost('password'));
        $phone = strip_tags($this->request->getPost('phone'));
        $cityOfOrigin = strip_tags($this->request->getPost('domicile'));
        $birthDate = strip_tags($this->request->getPost('birth_date'));
        $cityId = strip_tags($this->request->getPost('city_id'));
        $trackId = strip_tags($this->request->getPost('track_id'));
        return TalentWriteDataObject::signUpRequest($name, $userName, $email, $password, $phone, $cityOfOrigin, $birthDate, $cityId, $trackId);
    }
} 



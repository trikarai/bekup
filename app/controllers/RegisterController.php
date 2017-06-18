<?php
use Phalcon\Filter;
use Phalcon\Tag as Tag;

use Talent\Profile\ApplicationService\Talent\SignUpTalentDiloService;
use Talent\Profile\DomainModel\Talent\DataObject\TalentWriteDataObject;
use City\Profile\ApplicationService\City\QueryCityService;
use Track\Definition\ApplicationService\Track\QueryTrackService;
 
class RegisterController extends ControllerBase{    
    function basicAction(){
        $this->view->cityList = $this->_getCityList();
        $this->view->trackList = $this->_getTrackList();
        $this->view->genderList = $this->_getGenderList();
    }
    function basicDiloMemberAction(){
        $this->view->cityList = $this->_getCityList();
        $this->view->trackList = $this->_getTrackList();
        $this->view->genderList = $this->_getGenderList();
    }
    
    function startAction(){
        $this->view->cityList = $this->_getCityList();
        $this->view->genderList = $this->_getGenderList();
    }
    function startDiloMemberAction(){
        $this->view->cityList = $this->_getCityList();
        $this->view->genderList = $this->_getGenderList();
    }
    
    function journeyAction(){
        $this->view->cityList = $this->_getCityList();
        $this->view->genderList = $this->_getGenderList();
    }
    function journeyDiloMemberAction(){
        $this->view->cityList = $this->_getCityList();
        $this->view->genderList = $this->_getGenderList();
    }

    function signupBasicAction(){
        return $this->forward($this->_signup('basic'));
    }
    function signupStartAction(){
        return $this->forward($this->_signup('start'));
    }
    function signupJourneyAction(){
        return $this->forward($this->_signup('journey'));
    }
    function signupBasicDiloMemberAction($bekupType){
        return $this->forward($this->_signupDiloMemberAction('basic'));
    }
    function signupStartDiloMemberAction(){
        return $this->forward($this->_signupDiloMemberAction('start'));
    }
    function signupJourneyDiloMemberAction(){
        return $this->forward($this->_signupDiloMemberAction('journey'));
    }
    
    protected function _signup($bekupType){
        if(!$this->request->isPost() || !$this->_verifyCaptcha()){
            return "register/$bekupType";
        }
        $service = $this->_signUpTalentDiloService();
        $trackId = strip_tags($this->request->getPost('track_id'));
        $email = strip_tags($this->request->getPost('email'));
        $request = $this->_getRequest($bekupType, $email, $trackId);
        
        $response = $service->prepareTalentData($request);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return "register/$bekupType";
        }
        $jsonObjectResponse = $this->_getDiloRegisterResponse(urlencode($request->getName), urlencode($request->getUserName()), $request->getEmail(), urlencode($request->getPassword()));
        if("Success" !== $jsonObjectResponse->message){
            $this->flash->error($jsonObjectResponse->message);
            return "register/$bekupType";
        }
        $saveResponse = $service->execute();
        if(false === $saveResponse->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return "register/$bekupType";
        }
        $this->flash->success('sign up successfull, please check email to confirm');
        return "login/index";
    }

    protected function _signupDiloMember($bekupType){
        if(!$this->request->isPost() || !$this->_verifyCaptcha()){
            return "register/$bekupType" . "DiloMember";
        }
        $service = $this->_signUpTalentDiloService();
        $trackId = strip_tags($this->request->getPost('track_id'));
        $userName = strip_tags($this->request->getPost('user_name'));
        $password = strip_tags($this->request->getPost('password'));
        $jsonObjectResponse = $this->_getDiloLoginResponse(urlencode($userName), urlencode($password));
        if("success" !== $jsonObjectResponse->message){
            $this->flash->error("Akun Dilo tidak ditemukan, silahkan registrasi di form berikut");
            return "register/$bekupType";
        }
        $email = $jsonObjectResponse->email;
        if(empty($email)){
            $this->flash->error("Akun Dilo Anda belum aktif, silahkan aktifkan melalui email");
            return "register/$bekupType" . "DiloMember";
        }
        $request = $this->_getRequest($bekupType, $email, $trackId);
        $response = $service->prepareTalentData($request);
        if(false === $response->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return "register/$bekupType" . "DiloMember";
        }$saveResponse = $service->execute();
        if(false === $saveResponse->getStatus()){
            $this->displayErrorMessages($response->errorMessage()->getDetails());
            return "register/$bekupType";
        }
        $this->flash->success('sign up successfull, please check email to confirm');
        return "login/index";
    }
    
    protected function _getDiloRegisterResponse($name, $userName, $email, $password){
        $url = "http://dilo.id/index.php?option=com_hoicoiapi&task=registration&name=$name&username=$userName&passwd=$password&email=$email&token=asdarsessssdiher8b8^6vdtsutv$^%fhffvsgjd6$^%vyutdgfjsdfis";
        $jsonResponse = file_get_contents($url);
        $jsonObject = json_decode($jsonResponse);
        return $jsonObject;
    }
    protected function _getDiloLoginResponse($userName, $password){
        $url = "http://dilo.id/index.php?option=com_hoicoiapi&task=login&username=$userName&pass=$password&token=asdarsessssdiher8b8^6vdtsutv$^%fhffvsgjd6$^%vyutdgfjsdfis";
        $jsonResponse = file_get_contents($url);
        $jsonObject = json_decode($jsonResponse);
        return $jsonObject;
    }
    protected function _cityRdoRepository(){
        return $this->em->getRepository('\Superclass\DomainModel\City\CityReadDataObject');
    }
    protected function _trackRdoRepository(){
        return $this->em->getRepository('\Superclass\DomainModel\Track\TrackReadDataObject');
    }
    protected function _signUpTalentDiloService(){
        $talentRepository = $this->em->getRepository('\Talent\Profile\DomainModel\Talent\Talent');
        return new SignUpTalentDiloService($talentRepository, $this->_cityRdoRepository(), $this->_trackRdoRepository());
    }
    protected function _getTrackList(){
        $service = new QueryTrackService($this->_trackRdoRepository());
        $response = $service->showAll();
        return $response->toArrayOfIdNameList();
    }
    protected function _getCityList(){
        $service = new QueryCityService($this->_cityRdoRepository());
        $response = $service->showAll();
        return $response->toArrayOfIdNameList();
    }
    protected function _getGenderList(){
        return array(
            "M" => "Male",
            "F" => "Female",
        );
    }
    protected function _verifyCaptcha(){
        $captcha = $this->request->getPost('g-recaptcha-response');
        if(!$captcha){
            $this->flash->error('Please input captcha');
            return false;
        } else {
            $secretKey = "6LcJtSUUAAAAAJfDDzKlhP5CI4oOGC70MhJ_398r";
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha);

            if(json_decode($response)->success === true){
                return true;
            } else {
                $this->flash->error('Wrong captcha');
                return false;
            }
        }
    }

    protected function _getRequest($bekupType, $email, $trackId = null){
        $name = strip_tags($this->request->getPost('name'));
        $userName = strip_tags($this->request->getPost('user_name'));
        $password = strip_tags($this->request->getPost('password'));
        $phone = strip_tags($this->request->getPost('phone'));
        $cityOfOrigin = strip_tags($this->request->getPost('city_of_origin'));
        $birthDate = strip_tags($this->request->getPost('birth_date'));
        $gender = strip_tags($this->request->getPost('gender'));
        $motivation = strip_tags($this->request->getPost('motivation'));
        $cityId = strip_tags($this->request->getPost('city_id'));
        return TalentWriteDataObject::signUpRequest($name, $userName, $email, $password, $phone, $cityOfOrigin, $birthDate, $gender, $bekupType, $motivation, $cityId, $trackId);
    }
} 



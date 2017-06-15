<?php
use Phalcon\Filter;

use Usage\Application\Service\Talent\SignUpTalentService;
use Managerial\Application\Service\City\Helper\ExternalCityFinderHelper;
use Managerial\Application\Service\Track\Helper\ExternalTrackFinderHelper;
use Usage\Application\Service\Talent\TalentDTO;

use Usage\Domain\Model\Talent\Exception\DuplicateTalentEmailException;
use Usage\Domain\Model\Talent\Exception\DuplicateTalentUserNameException;
 
class RegisterController extends ControllerBase{    
    
    public function indexAction() {
        $this->view->cities = $this->_getExternalCityFinderHelper()->getAllQueryCityDTO();
        $this->view->tracks = $this->_getExternalTrackFinderHelper()->getAllQueryTrackDTOs();		
		 
    }
	
    public function diloAction() {
        $this->view->cities = $this->_getExternalCityFinderHelper()->getAllQueryCityDTO();
        $this->view->tracks = $this->_getExternalTrackFinderHelper()->getAllQueryTrackDTOs();		
		 
    }
    
    protected function getRequestDTO($email){
        $name = strip_tags($this->request->getPost('name'));
        $userName = strip_tags($this->request->getPost('user_name'));
        $password = strip_tags($this->request->getPost('password'));        
        $phone = strip_tags($this->request->getPost('phone'));
        $birthDate = strip_tags($this->request->getPost('birth_date'));
        $cityId = strip_tags($this->request->getPost('city_id'));
        $trackId = strip_tags($this->request->getPost('track_id'));
        $domicile = strip_tags($this->request->getPost('domicile'));
        return TalentDTO::signUpRequest($name, $userName, $email, $password, $phone, $birthDate, $cityId, $trackId, $domicile);
    }
	
    public function DiloRegisterAction(){
        if(!$this->request->isPost() || !$this->verifiedCaptcha()){
            return $this->forward('register/dilo');
        }
        $userName = strip_tags($this->request->getPost('user_name'));
        $password = strip_tags($this->request->getPost('password'));        
    
        $jsonObjectResponse = $this->_getDiloLoginResponse(urlencode($userName), urlencode($password));
        if("success" !== $jsonObjectResponse->message){
            $this->flash->error("Akun Dilo tidak ditemukan, silahkan registrasi di form berikut");
            return $this->forward('register/index');
        }
        $email = $jsonObjectResponse->email;

        $request = $this->getRequestDTO($email);
        $service = new SignUpTalentService($this->_getTalentRepository(), $this->_getExternalCityFinderHelper(), $this->_getExternalTrackFinderHelper());
        try{
            $service->prepareTalentData($request);
            $service->execute();
            $this->flash->success("Sign Up Successfull");
        } catch (DuplicateTalentEmailException $err){
            $this->flash->error('Emaill already registered');
        } catch (DuplicateTalentUserNameException $error){
            $this->flash->error('Usernama already registered');
        }
        return $this->forward('register/dilo');
    }
    
    public function RegisterAction() {
        if(!$this->request->isPost() || !$this->verifiedCaptcha()){
            return $this->forward('register/index');
        }
        $name = strip_tags($this->request->getPost('name'));
        $userName = strip_tags($this->request->getPost('user_name'));
        $email = strip_tags($this->request->getPost('email'));
        $password = strip_tags($this->request->getPost('password'));
        $request = $this->getRequestDTO($email);
        
        $service = new SignUpTalentService($this->_getTalentRepository(), $this->_getExternalCityFinderHelper(), $this->_getExternalTrackFinderHelper());
        try{
            $service->prepareTalentData($request);
            $this->flash->success("Sign Up Successfull, please check your email for activation");
        } catch (DuplicateTalentEmailException $err){
            $this->flash->error('Email already registered');
            return $this->forward('register/index');
        } catch (DuplicateTalentUserNameException $error){
            $this->flash->error('Usernama already registered');
            return $this->forward('register/index');
        }
        
        $jsonObjectResponse = $this->_getDiloRegisterResponse(urlencode($name), urlencode($userName), $email, urlencode($password));
        if("Success" !== $jsonObjectResponse->message){
            $this->flash->error($jsonObjectResponse->message);
            return $this->forward('register/index');
        }
        $service->execute();

//        try{
//            $service->execute();
//            $this->flash->success("Sign Up Successfull, please check your email for activation");
//        } catch (DuplicateTalentEmailException $err){
//            $this->flash->error('Emaill already registered');
//        } catch (DuplicateTalentUserNameException $error){
//            $this->flash->error('Usernama already registered');
//        }
        return $this->forward('register/index');
    }
	
    protected function verifiedCaptcha(){
return true;
        $captcha = $this->request->getPost('g-recaptcha-response');

        if(!$captcha){
            $this->flash->error('Please input captcha');
            return false;
        } else {

            $secretKey = "6LdEWBkUAAAAAD5TcbZhtUqZ7kjMYl0XYYItCJLN";
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha);

            if(json_decode($response)->success === true){
//            	$this->flash->success('Thank you for posting comment');
                return true;
            } else {
                $this->flash->error('Wrong captcha');
                return false;
            }
        }
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
    
    protected function _getTalentRepository(){
        return $this->em->getRepository('Usage\Domain\Model\Talent\Talent');
    }
    /**
     * @return ExternalTrackFinderHelper
     */
    protected function _getExternalTrackFinderHelper(){
        $trackRepository = $this->em->getRepository('\Managerial\Domain\Model\Track\Track');
//        $trackRepository = $this->em->getRepository('\Managerial\Domain\Model\Track\PropagateTrack');
        return new ExternalTrackFinderHelper($trackRepository);
    }
    /**
     * @return ExternalCityFinderHelper
     */
    protected function _getExternalCityFinderHelper(){
        $cityRepository = $this->em->getRepository('\Managerial\Domain\Model\City\City');
        return new ExternalCityFinderHelper($cityRepository);
    }
}
    



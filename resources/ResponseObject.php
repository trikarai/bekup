<?php

namespace Resources;

class ResponseObject {
    protected $status = true;
    protected $errorMessage;
    
    function getStatus(){
        return $this->status;
    }
    /**
     * @return ErrorMessage
     */
    function errorMessage(){
        return $this->errorMessage;
    }


    public function __construct() {
        ;
    }
    
    function appendErrorMessage(ErrorMessage $errorMessage){
        $this->status = false;
        $this->errorMessage = $errorMessage;
    }
}

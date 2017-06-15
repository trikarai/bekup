<?php

namespace Resources;

class ErrorMessage {
    protected $code;
    protected $type;
    protected $details = [];
    
    function getCode(){
        return $this->code;
    }
    function getType(){
        return $this->type;
    }
    /**
     * @return array
     */
    function getDetails(){
        return $this->details;
    }
    function toArray(){
        return array(
            'code' => $this->getCode(),
            'type' => $this->getType(),
            'details' => $this->getDetails(),
        );
    }
    
    protected  function __construct($code, $type, array $details = []) {
        $this->code = $code;
        $this->type = $type;
        $this->details = $details;
    }
    
    static function error400_BadRequest(array $details = []){
        return new static(400, 'Bad Request', $details);
    }
    static function error401_Unauthorized(array $details = []){
        return new static(401, 'Unauthorized', $details);
    }
    static function error403_Forbidden(array $details = []){
        return new static(403, 'Forbidden', $details);
    }
    static function error404_NotFound(array $details = []){
        return new static(404, 'Not Found', $details);
    }
    static function error409_Conflict(array $details = []){
        return new static(409, 'Conflict', $details);
    }
    static function error500_InternalServerError(array $details = []){
        return new static(500, 'Internal Server Error', $details);
    }
}

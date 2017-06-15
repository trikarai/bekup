<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonEmailAbstract{
    protected $email;
    
    /**
     * @param string $email
     * @throws InvalidNativeArgumentException
     */
    protected function __construct($email) {
        $filteredEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if(empty($filteredEmail)){
            $this->_throwInvalidArgumentExceptionStatement($email, array('email string'));
      }
        $this->email = $filteredEmail;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($email, array $allowed_types);
    
    /**
     * @param string $email
     * @throws InvalidNativeArgumentException
     */
    public static function fromNative($email){
        return new static($email);
    }
    
    /** @return string */
    public function value(){
        return $this->email;
    }

    /** @return string */
    public function __toString() {
        return $this->value();
    }
    
    /**
     * @param \Resources\ValueObject\CommonEmailAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonEmailAbstract $other) {
        return ($this->value() === $other->value());
    }

}

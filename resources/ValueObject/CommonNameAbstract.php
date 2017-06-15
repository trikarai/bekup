<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonNameAbstract{
    protected $name;
    
    /**
     * @param type $name
     * @throws InvalidNativeArgumentException
     */
    protected function __construct($name) {
        if(empty($name)){
            $this->_throwInvalidArgumentExceptionStatement($name, array('not empty string'));
        }
        $this->name = $name;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($name, array $allowed_types);
    
    public static function fromNative($name){
        return new static($name);
    }
    
    /** @return string */
    public function value(){
        return $this->name;
    }
    
    /** @return string */
    public function __toString() {
        return $this->value();
    }
    
    /**
     * @param \Resources\ValueObject\CommonNameAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonNameAbstract $other) {
        return ($this->value() === $other->value());
    }
}
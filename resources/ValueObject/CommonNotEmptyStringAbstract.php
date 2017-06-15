<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonNotEmptyStringAbstract {
    /**
     * @var string
     */
    protected $input;
    
    /**
     * @param string $input
     * @throws InvalidNativeArgumentException
     */
    protected function __construct($input) {
        if(empty($input)){
            $this->_throwInvalidArgumentExceptionStatement($input, array('not empty string'));
        }
        $this->input = $input;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($input, array $allowed_types);
    
    /**
     * @param string $input
     * @throws InvalidNativeArgumentException
     */
    public static function fromNative($input){
        return new static($input);
    }
    
    /**
     * @return string
     */
    public function value(){
        return $this->input;
    }
    
    /**
     * @return string
     */
    public function toString(){
        return $this->value();
    }
    
    /**
     * @param \Resources\ValueObject\CommonNotEmptyStringAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonNotEmptyStringAbstract $other){
        return ($this->value() === $other->value());
    }
    
}

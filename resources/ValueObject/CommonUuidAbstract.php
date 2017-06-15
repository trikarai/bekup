<?php

namespace Resources\ValueObject;

use Ramsey\Uuid\Uuid;
use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonUuidAbstract{
    /** @var string */
    protected $uuid;
    
    /**
     * @param string $uuid
     * @throws InvalidNativeArgumentException
     */
    protected function __construct($uuid) {
        if(!Uuid::isValid($uuid)){
            $this->_throwInvalidArgumentExceptionStatement($uuid, array('uuid-4 string'));
        }
        $this->uuid = $uuid;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($uuid, array $allowed_types);


    /** @return \static */
    public static function generateNew(){
        return new static(strtolower(Uuid::uuid4()->toString()));
    }
    
    /**
     * @param string $uuidString
     * @return \static
     * @throws InvalidNativeArgumentException
     */
    public static function fromString($uuidString){
        return new static($uuidString);
    }

    /** @return string */
    public function value(){
        return $this->uuid;
    }
    
    /**
     * @param CommonUuidAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonUuidAbstract $other) {
        return (strtolower($this->value()) === strtolower($other->value()));
    }
    
    /** @return string */
    public function __toString() {
        return $this->value();
    }
}

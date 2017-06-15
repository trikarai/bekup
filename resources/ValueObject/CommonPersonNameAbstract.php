<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonPersonNameAbstract{
    protected $firstName;
    protected $middleName;
    protected $lastName;
    
    protected function _assignFirstName($firstName){
        $filteredFirstName = strip_tags($firstName);
        if(empty($filteredFirstName)){
            $this->_throwInvalidArgumentExceptionStatement($firstName, array('not empty string'));
        }
        $this->firstName = $filteredFirstName;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($firstName, array $allowed_types);
    
    /**
     * @param string $firstname
     * @param string $middleName
     * @param string $lastName
     * @throw InvalidNativeArgumentException
     */
    protected function __construct($firstName, $middleName, $lastName) {
        $this->_assignFirstName($firstName);
        $this->middleName = strip_tags($middleName);
        $this->lastName = strip_tags($lastName);
    }
    
    /**
     * @param string $firstname
     * @param string $middleName
     * @param string $lastName
     * @throw InvalidNativeArgumentException
     */
    public static function fromNative($firstName, $middleName = null, $lastName = null){
        return new static($firstName, $middleName, $lastName);
    }
    
    /** @return string */
    public function firstName(){
        return $this->firstName;
    }
    /** @return string */
    public function middleName(){
        return $this->middleName;
    }
    /** @return string */
    public function lastName(){
        return $this->lastName;
    }
    /** @return string */
    public function fullName(){
        return $this->firstName . 
                (empty($this->middleName)? "": " " . $this->middleName) .
                (empty($this->lastName)? "": " " . $this->lastName);
    }
    
    /** @return string */
    public function __toString() {
        return $this->fullName();
    }
    
    /**
     * @param CommonPersonNameAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonPersonNameAbstract $other) {
        return ($this->firstName === $other->firstName &&
                $this->middleName === $other->middleName() &&
                $this->lastName === $other->lastName()
        );
    }

}

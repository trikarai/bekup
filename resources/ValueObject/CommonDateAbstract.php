<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonDateAbstract {
    /**
     * @var string
     */
    protected $date;
    
    /**
     * @param string $date
     * @throws InvalidNativeArgumentException
     */
    protected function __construct($date) {
        $dateRegex = "/^(19|20)\d{2}[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/";//yyyy-mm-dd date format
        $filteredDate = filter_var($date, FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=>$dateRegex)));//validate correct date
        
        if(empty($filteredDate)){
            $this->_throwInvalidArgumentExceptionStatement($date, array('YYYY-mm-dd date format'));
      }
        $this->date = $filteredDate;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($date, array $allowed_types);
    
    /**
     * @param string $date
     * @throws InvalidNativeArgumentException
     */
    public static function fromNative($date){
        return new static($date);
    }
    
    /** @return string */
    public function value(){
        return $this->date;
    }
    
    /** @return string */
    public function __toString() {
        return $this->value();
    }
    
    /**
     * @param CommonDateAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonDateAbstract $other) {
        return ($this->value() === $other->value());
    }
}
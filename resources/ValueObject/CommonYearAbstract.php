<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;

abstract class CommonYearAbstract {
    /**
     * @var int
     */
    protected $year;
    
    /**
     * @param int $year
     * @throws InvalidNativeArgumentException
     */
    protected function __construct($year) {
        $yearRegex = "/^\d{4}$/";
        $filteredYear = filter_var($year, FILTER_VALIDATE_REGEXP, array('options'=>(array('regexp'=>$yearRegex))));
        if(empty($filteredYear)){
            $this->_throwInvalidArgumentExceptionStatement($year, array('4 digit Year Integer'));
        }
        $this->year = $filteredYear;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($year, array $allowed_types);
    
    public static function fromNative($year){
        return new static ($year);
    }
    
    /**
     * @return int
     */
    public function value(){
        return $this->year;
    }
    
    /**
     * @return string
     */
    public function toString(){
        return strval($this->value());
    }
    
    /**
     * @param \Resources\ValueObject\CommonYearAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonYearAbstract $other){
        return ($this->value() === $other->value());
    }

}

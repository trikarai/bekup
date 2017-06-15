<?php

namespace Resources\ValueObject;

use Resources\Exception\InvalidNativeArgumentException;
use Resources\Exception\UnreasonableTimeIntervalException;

abstract class CommonYearIntervalAbstract {
        /** @var int */
    protected $startYear;
    /** @var int */
    protected $endYear;
    
    
    /**
     * @param int $startYear
     * @param int $endYear
     * @throws InvalidNativeArgumentException
     * @throws UnreasonableTimeIntervalException
     */
    public static function fromNative($startYear, $endYear = null){
        return new static($startYear, $endYear);
    }
    
    /**
     * @param int $startYear
     * @param int $endYear
     * @throws InvalidNativeArgumentException
     * @throws UnreasonableTimeIntervalException
     */
    protected function __construct($startYear, $endYear = null) {
        $this->_setStartYear($startYear);
        $this->_setEndYear($endYear);
    }
    /**
     * @param int $startYear
     * @throws InvalidNativeArgumentException
     */
    protected function _setStartYear($startYear){
        $this->startYear = $this->_filterYear($startYear, "start year");
    }
    protected function _filterYear($year, $fieldName){
        $yearRegex = "/^\d{4}$/";
        $filteredYear = filter_var($year, FILTER_VALIDATE_REGEXP, array('options'=>(array('regexp'=>$yearRegex))));
        if(empty($filteredYear)){
            $this->_throwInvalidArgumentExceptionStatement($year, $fieldName, array('4 digit Year integer'));
        }
        return $filteredYear;
    }
    
    abstract protected function _throwInvalidArgumentExceptionStatement($year, $fieldName, array $allowed_types);
    /**
     * @param int $endYear
     * @throws InvalidNativeArgumentException
     * @throws UnreasonableTimeIntervalException
     */
    protected function _setEndYear($endYear){
        if(null === $endYear){
            return;
        }
        $filteredEndYear = $this->_filterYear($endYear, "end year");
        if($filteredEndYear < $this->startYear){
            throw new UnreasonableTimeIntervalException();
        }
        $this->endYear = $filteredEndYear;
    }
    
    /** @return int */
    public function startYear(){
        return intval($this->startYear);
    }
    
    /** @return int */
    public function endYear(){
        return intval($this->endYear);
    }
    
    public function interval(){
        if(null === $this->endYear){
            return null;
        }
        return($this->endYear() - $this->startYear());
    }
    
    /**
     * @param \Resources\ValueObject\CommonYearIntervalAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonYearIntervalAbstract $other){
        return($this->startYear() === $other->startYear() &&
                $this->endYear() === $other->endYear()
        );
    }
}
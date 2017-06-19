<?php

namespace Resources\ValueObject;

abstract class CommonYearIntervalStartFromPastTimeAbstract {
    protected $startYear;
    protected $endYear = null;
    
    abstract protected function _throwCathableException($fieldName, $message);
    
    public function __construct($startYear, $endYear = null) {
        $this->_setStartYear($startYear);
        $this->_setEndYear($endYear);
    }
    
    protected function _setStartYear($startYear){
        if($startYear > date('Y')){
            $this->_throwCathableException('start year', "$startYear is bigger than current year");
        }
        $this->startYear = $startYear;
    }
    
    protected function _setEndYear($endYear = null){
        if(empty($endYear)){
            return;
        }
        if($endYear < $this->startYear){
            $this->_throwCathableException('end year', "end year '$endYear' is less than start year'$this->startYear'");
        }
        $this->endYear = $endYear;
    }
    
    /**
     * @param type $startYear
     * @param type $endYear
     * @return \static
     */
    static function fromNative($startYear, $endYear = null){
        return new static($startYear, $endYear);
    }
    
    /**
     * @return string
     */
    function getStartYear(){
        return $this->startYear;
    }
    
    /**
     * @return string
     */
    function getEndYear(){
        return $this->endYear;
    }
    
    /**
     * @param \Talent\Education\DomainModel\Education\ValueObject\EducationTime $other
     * @return boolean
     */
    function sameValueAs(CommonYearIntervalStartFromPastTimeAbstract $other){
        return ($this->getStartYear() === $other->getStartYear() &&
                $this->getEndYear() === $other->getEndYear());
    }
}

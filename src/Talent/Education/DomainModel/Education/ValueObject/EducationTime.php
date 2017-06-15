<?php

namespace Talent\Education\DomainModel\Education\ValueObject;

use Resources\Exception\CatchableException;

class EducationTime{
    protected $startYear;
    protected $endYear = null;
    
    function getStartYear(){
        return $this->startYear;
    }
    function getEndYear(){
        return $this->endYear;
    }
    
//    protected function __construct($startYear, $endYear = null) {
//        $this->startYear = $startYear;
//        $this->endYear = $endYear;
//    }
    
    /**
     * @param type $startYear
     * @param type $endYear
     * @throw CatchableException
     */
    public function __construct($startYear, $endYear = null) {
        $this->_setStartYear($startYear);
        $this->_setEndYear($endYear);
    }
    protected function _setStartYear($startYear){
        if($startYear > date('Y')){
            throw new CatchableException("education 'start year':'$startYear' cannot be in future");
        }
        $this->startYear = $startYear;
    }
    protected function _setEndYear($endYear = null){
        if(null === $endYear){
            return;
        }
        if($endYear < $this->startYear){
            throw new CatchableException("education 'end year': '$endYear' must be after 'start year': '{$this->startYear}'");
        }
        $this->endYear = $endYear;
    }
    
    static function fromNative($startYear, $endYear = null){
        return new static($startYear, $endYear);
    }
    
    /**
     * @param \Talent\Education\DomainModel\Education\ValueObject\EducationTime $other
     * @return boolean
     */
    function sameValueAs(EducationTime $other){
        return ($this->getStartYear() === $other->getStartYear() &&
                $this->getEndYear() === $other->getEndYear()
        );
    }
    
}
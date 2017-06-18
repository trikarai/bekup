<?php

namespace Talent\Organizational\DomainModel\Organizational\ValueObject;

use Resources\Exception\CatchableException;

class OrganizationalTime {
    protected $startYear;
    protected $endYear = null;
    
    function getStartYear(){
        return $this->startYear;
    }
    function getEndYear(){
        return $this->endYear;
    }
    
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
            throw new CatchableException("organizational 'start year':'$startYear' cannot be in future");
        }
        $this->startYear = $startYear;
    }
    protected function _setEndYear($endYear = null){
        if(null === $endYear){
            return;
        }
        if($endYear < $this->startYear){
            throw new CatchableException("organizational 'end year': '$endYear' must be after 'start year': '{$this->startYear}'");
        }
        $this->endYear = $endYear;
    }
    
    static function fromNative($startYear, $endYear = null){
        return new static($startYear, $endYear);
    }
    
    /**
     * @param \Talent\Organizational\DomainModel\Organizational\ValueObject\OrganizationalTime $other
     * @return boolean
     */
    function sameValueAs(OrganizationalTime $other){
        return ($this->getStartYear() === $other->getStartYear() &&
                $this->getEndYear() === $other->getEndYear()
        );
    }
}

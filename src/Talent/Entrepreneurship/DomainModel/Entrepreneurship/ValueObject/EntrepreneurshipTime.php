<?php

namespace Talent\Entrepreneurship\DomainModel\Entrepreneurship\ValueObject;

use Resources\Exception\CatchableException;

class EntrepreneurshipTime {
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
            throw new CatchableException("Entrepreneurship 'start year':'$startYear' cannot be in future");
        }
        $this->startYear = $startYear;
    }
    protected function _setEndYear($endYear = null){
        if(null === $endYear){
            return;
        }
        if($endYear < $this->startYear){
            throw new CatchableException("Entrepreneurship 'end year': '$endYear' must be after 'start year': '{$this->startYear}'");
        }
        $this->endYear = $endYear;
    }
    
    static function fromNative($startYear, $endYear = null){
        return new static($startYear, $endYear);
    }
    
    /**
     * @param \Talent\Entrepreneurship\DomainModel\Entrepreneurship\ValueObject\EntrepreneurshipTime $other
     * @return type
     */
    function sameValueAs(EntrepreneurshipTime $other){
        return ($this->getStartYear() === $other->getStartYear() &&
                $this->getEndYear() === $other->getEndYear()
        );
    }
}

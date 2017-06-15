<?php

namespace Resources\ValueObject;

abstract class CommonDateIntervalAbstract {
    /**@var \DateTime*/
    protected $startDate;
    /**@var \DateTime*/
    protected $endDate;
    
    /** @return \DateTime */
    function getStartDate() {
        return $this->startDate;
    }
    /** @return \DateTime */
    function getEndDate() {
        return $this->endDate;
    }
    
    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return \static
     * @throw CatchableException
     */
    public static function fromNative(\DateTime $startDate, \DateTime $endDate){
        return new static($startDate, $endDate);
    }
    
    protected  function __construct(\DateTime $startDate, \DateTime $endDate) {
        $this->startDate = $startDate;
        if($endDate < $startDate){
            $this->_throwInvalidArgumentException($startDate, $endDate);
        }
        $this->endDate = $endDate;
    }

    /**
     * @param \Resources\ValueObject\CommonDateIntervalAbstract $other
     * @return boolean
     */
    public function sameValueAs(CommonDateIntervalAbstract $other){
        return ($this->getStartDate() === $other->getStartDate() &&
                $this->getEndDate() === $other->getEndDate());
    }
    
    /**
     * 
     */
    abstract protected function _throwInvalidArgumentException(\DateTime $startDate, \DateTime $endDate);
    
}

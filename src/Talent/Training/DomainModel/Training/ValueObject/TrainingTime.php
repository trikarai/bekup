<?php

namespace Talent\Training\DomainModel\Training\ValueObject;

class TrainingTime {
    protected $time;
    
    function getTime() {
        return $this->time;
    }

    /**
     * @param type $time
     * @throws \Resources\Exception\CatchableException
     */
    protected function __construct($time) {
        if($time > date('Y')){
            throw new \Resources\Exception\CatchableException("training time: '$time' cannot be in future");
        }
        $this->time = $time;
    }
    /**
     * @param type $time
     * @return \static
     * @throws \Resources\Exception\CatchableException
     */
    static function fromNative($time){
        return new static($time);
    }
    
    /**
     * @param \Talent\Training\DomainModel\Training\ValueObject\TrainingTime $other
     * @return boolean
     */
    function sameValuAs(TrainingTime $other){
        return ($this->getTime() === $other->getTime());
    }

}

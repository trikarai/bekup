<?php

namespace Programme\Description\DomainModel\Programme\Event;

use Resources\IDomainEvent;

class ProgrammeWasCreatedEvent implements IDomainEvent{
    protected $occuredOn;
    protected $programmeId;
    
    public function __construct($programmeId) {
        $this->occuredOn = new \DateTime();
        $this->programmeId = $programmeId;
    }

    /**
     * @return string
     */
    public function getEventName() {
        return "ProgrammeWasCreatedEvent";
    }

    function getProgrammeId(){
        return $this->programmeId;
    }
    /**
     * @return \DateTime
     */
    public function occuredOn() {
        return $this->occuredOn;
    }
}

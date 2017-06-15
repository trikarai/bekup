<?php

namespace City\Programme\Description\DomainModel\City\Event;

use Resources\DomainEventSubscriberAbstract;
use Programme\Description\DomainModel\Programme\Event\ProgrammeWasCreatedEvent;

class ProgrammeWasCreatedSubscriber extends DomainEventSubscriberAbstract{
    protected $cityRepository;
    
    public function __construct(\City\Programme\Description\DomainModel\City\ICityRepository $cityRepository) {
        $this->cityRepository = $cityRepository;
    }
    
    protected function _subscribedDomainEvent() {
        return array(
            "ProgrammeWasCreatedEvent",
        );
    }
    /**
     * @param ProgrammeWasCreatedEvent $aDomainEvent
     * @throws Exception
     */
    public function handle($aDomainEvent) {
        $referenceProgrammeId = $aDomainEvent->getProgrammeId();
        foreach($this->cityRepository->all() as $cityProgramme){
            if(true !== $msg = $cityProgramme->addProgramme($referenceProgrammeId, false)){
                throw new \Exception($msg->getDetails()[0]);
            }
        }
    }
}

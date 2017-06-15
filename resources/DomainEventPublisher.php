<?php

namespace Resources;

final class DomainEventPublisher {
    /**
     * @var IDomainEventSubscriber[]
     */
    private $subscribers;
    private static $instance = null;
    
    /**
     * @return static
     */
    static function instance(){
        if(null === static::$instance){
            static::$instance = new static();
        }
        return static::$instance;
    }
    
    private function __construct() {
        $this->subscribers = [];
    }
    private function __clone() {
        
    }
    
    function subscribe(IDomainEventSubscriber $aDomainEventSubscriber){
        $this->subscribers[] = $aDomainEventSubscriber;
    }
    
    function publish(IDomainEvent $anEvent){
        foreach($this->subscribers as $aSubscriber){
            if($aSubscriber->isSubscribedTo($anEvent->getEventName())){
                $aSubscriber->handle($anEvent);
            }
        }
    }
}

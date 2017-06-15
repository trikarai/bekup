<?php

namespace Resources;

abstract class DomainEventSubscriberAbstract implements IDomainEventSubscriber{
    abstract public function handle($aDomainEvent);

    public function isSubscribedTo($aDomainEventName) {
        if(in_array($aDomainEventName, $this->_subscribedDomainEvent())){
            return true;
        }
        return false;
    }
    
    /**
     * @return array
     */
    abstract protected function _subscribedDomainEvent();
}

<?php

namespace Resources;

interface IDomainEventSubscriber {
    function handle($aDomainEvent);
    
    /**
     * @param type $aDomainEventName
     * @return boolean
     */
    function isSubscribedTo($aDomainEventName);
}

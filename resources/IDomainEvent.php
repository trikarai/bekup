<?php

namespace Resources;

interface IDomainEvent {
    /**
     * @return \DateTime
     */
    function occuredOn();
    
    /**
     * @return string
     */
    function getEventName();
}

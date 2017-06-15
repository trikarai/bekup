<?php

namespace Programme\Description\DomainModel\Programme;

use Programme\Description\DomainModel\Programme\DataObject\ProgrammeReadDataObject;
use Programme\Description\DomainModel\Programme\DataObject\ProgrammeWriteDataObject;
use Programme\Description\DomainModel\Programme\ValueObject\ProgrammeRegistrationDateRange;
use Programme\Description\DomainModel\Programme\ValueObject\ProgrammeOperationDateRange;
use Programme\Description\DomainModel\Programme\Event\ProgrammeWasCreatedEvent;

use Resources\DomainEventPublisher;
use Resources\Exception\CatchableException;
use Resources\ErrorMessage;

class Programme {
    protected $id;
    protected $name;
    /** @var ProgrammeRegistrationDateRange */
    protected $registrationDateRange;
    /** @var ProgrammeOperationDateRange */
    protected $operationDateRange;
    protected $isRemoved = false;
    
    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getIsRemoved(){
        return $this->isRemoved;
    }
    /**
     * @return ProgrammeReadDataObject
     */
//    function toReadDataObject(){
//        return new ProgrammeReadDataObject($this->id, $this->name, 
//                $this->registrationDateRange->getStartDate()->format('Y-m-d'), 
//                $this->registrationDateRange->getEndDate()->format('Y-m-d'), 
//                $this->operationDateRange->getStartDate()->format('Y-m-d'), 
//                $this->operationDateRange->getEndDate()->format('Y-m-d'), 
//                $this->isRemoved);
//    }
    
    /**
     * @param type $id
     * @param ProgrammeWriteDataObject $request
     * @throw CatchableException
     */
    public function __construct($id, ProgrammeWriteDataObject $request) {
        $this->id = $id;
        $this->name = $request->getName();
        $this->registrationDateRange = ProgrammeRegistrationDateRange::fromNative(
                new \DateTime($request->getRegistrationStartDate()), new \DateTime($request->getRegistrationEndDate()));
        $this->operationDateRange = ProgrammeOperationDateRange::fromNative(
                new \DateTime($request->getOperationStartDate()), new \DateTime($request->getOperationEndDate()));
        DomainEventPublisher::instance()->publish(new ProgrammeWasCreatedEvent($this->id));
    }
    
    /**
     * @param ProgrammeWriteDataObject $request
     * @return true||ErrorMessage
     */
    function change(ProgrammeWriteDataObject $request){
        try{
            $this->name = $request->getName();
            $this->registrationDateRange = ProgrammeRegistrationDateRange::fromNative(
                    new \DateTime($request->getRegistrationStartDate()), new \DateTime($request->getRegistrationEndDate()));
            $this->operationDateRange = ProgrammeOperationDateRange::fromNative(
                    new \DateTime($request->getOperationStartDate()), new \DateTime($request->getOperationEndDate()));
            return true;
        } catch (CatchableException $ex){
            return ErrorMessage::error400_BadRequest([$ex->getMessage()]);
        }
    }
    
    function remove(){
        $this->isRemoved = true;
    }
}

<?php

namespace Resources;

use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;
use Resources\ErrorMessage;

abstract class PersonnelAuthorizationServiceAbstract {
    /** 
     * @param PersonnelReadDataObject $personnelRDO
     * @return true||ErrorMessage
     */
    function isAuthorizedToAdd(PersonnelReadDataObject $personnelRDO){
        if(in_array($personnelRDO->getRole(), $this->_authorizedPersonnelRoles_toAdd())){
            return true;
        }
        return ErrorMessage::error401_Unauthorized(['unauthorized access']);
    }
    
    /** 
     * @param PersonnelReadDataObject $personnelRDO
     * @return true||ErrorMessage
     */
    function isAuthorizedToUpdate(PersonnelReadDataObject $personnelRDO){
        if(in_array($personnelRDO->getRole(), $this->_authorizedPersonnelRoles_toUpdate())){
            return true;
        }
        return ErrorMessage::error401_Unauthorized(['unauthorized access']);
    }
    
    /** 
     * @param PersonnelReadDataObject $personnelRDO
     * @return true||ErrorMessage
     */
    function isAuthorizedToRemove(PersonnelReadDataObject $personnelRDO){
        if(in_array($personnelRDO->getRole(), $this->_authorizedPersonnelRoles_toRemove())){
            return true;
        }
        return ErrorMessage::error401_Unauthorized(['unauthorized access']);
    }
    
    abstract protected function _authorizedPersonnelRoles_toAdd();
    abstract protected function _authorizedPersonnelRoles_toUpdate();
    abstract protected function _authorizedPersonnelRoles_toRemove();
}

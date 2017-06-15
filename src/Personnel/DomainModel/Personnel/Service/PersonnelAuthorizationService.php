<?php

namespace Personnel\DomainModel\Personnel\Service;

use Resources\Exception\DoNotCatchException;

use Personnel\DomainModel\Personnel\Personnel;
use Resources\PersonnelAuthorizationServiceAbstract;

class PersonnelAuthorizationService extends PersonnelAuthorizationServiceAbstract{
//    
//    /**
//     * @param Personnel $personnel
//     * @return boolean
//     * @throws DoNotCatchException
//     */
//    function assertIsAuthorizeToAdd(Personnel $personnel){
//        $authorizedPersonnel = array(
//            'Director',
//        );
//        
//        if(in_array($personnel->getRole(), $authorizedPersonnel)){
//            return true;
//        }
//        throw new DoNotCatchException("Unauthorize Access");
//    }
//    
//    /**
//     * @param Personnel $personnel
//     * @return boolean
//     * @throws DoNotCatchException
//     */
//    function assertIsAuthorizeToRemove(Personnel $personnel){
//        return $this->assertIsAuthorizeToAdd($personnel);
//    }

    protected function _authorizedPersonnelRoles_toAdd() {
        return ['Director'];
    }

    protected function _authorizedPersonnelRoles_toRemove() {
        return ['Director'];
    }

    protected function _authorizedPersonnelRoles_toUpdate() {
        return ['Director'];
    }

}

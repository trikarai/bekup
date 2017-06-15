<?php

namespace City\Profile\DomainModel\City\Service;

use Resources\PersonnelAuthorizationServiceAbstract;

class CityAuthorizationService extends PersonnelAuthorizationServiceAbstract{
    protected function _authorizedPersonnelRoles_toAdd() {
        return array(
            'Director',
        );
    }

    protected function _authorizedPersonnelRoles_toRemove() {
        return array(
            'Director',
        );
    }

    protected function _authorizedPersonnelRoles_toUpdate() {
        return array(
            'Director',
        );
    }

}

<?php

namespace Track\Definition\DomainModel\Track\Service;

use Resources\PersonnelAuthorizationServiceAbstract;

class TrackAuthorizationService extends PersonnelAuthorizationServiceAbstract{
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
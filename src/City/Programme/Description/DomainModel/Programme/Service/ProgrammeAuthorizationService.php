<?php

namespace City\Programme\Description\DomainModel\Programme\Service;

use Resources\PersonnelAuthorizationServiceAbstract;

class ProgrammeAuthorizationService extends PersonnelAuthorizationServiceAbstract{
    protected function _authorizedPersonnelRoles_toAdd() {
        return ["Director"];
    }

    protected function _authorizedPersonnelRoles_toRemove() {
        return ["Director"];
    }

    protected function _authorizedPersonnelRoles_toUpdate() {
        return ["Director"];
    }

}

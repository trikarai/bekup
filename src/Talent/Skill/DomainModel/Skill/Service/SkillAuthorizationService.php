<?php

 namespace Talent\Skill\DomainModel\Skill\Service;
 
 use Resources\PersonnelAuthorizationServiceAbstract;
 use Personnel\DomainModel\Personnel\DataObject\PersonnelReadDataObject;
 
 class SkillAuthorizationService extends PersonnelAuthorizationServiceAbstract{
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
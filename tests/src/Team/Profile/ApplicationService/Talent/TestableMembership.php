<?php

namespace Tests\Team\Profile\ApplicationService\Talent;

use Team\Profile\DomainModel\Membership\Membership;

class TestableMembership extends Membership{
    public function __construct() {
        $this->status = \Team\Profile\DomainModel\Membership\ValueObject\MembershipStatus::active();
    }
    function toTeamMemberReadDataObject() {
        return new TestableTeamMemberReadDataObject();
    }
    function toTalentMembershipReadDataObject() {
        return new TestableTalentMembershipReadDataObject();
    }
}
use Team\Profile\DomainModel\Membership\DataObject\TeamMemberReadDataObject;
class TestableTeamMemberReadDataObject extends TeamMemberReadDataObject{
    public function __construct() {
        
    }
}
use Team\Profile\DomainModel\Membership\DataObject\TalentMembershipReadDataObject;
class TestableTalentMembershipReadDataObject extends TalentMembershipReadDataObject{
    public function __construct() {
    }
}

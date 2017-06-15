<?php

namespace Tests\Team\Profile\DomainModel\Membership;

use Team\Profile\DomainModel\Membership\Membership;

class MembershipTest extends \PHPUnit_Framework_TestCase {
    protected $membership;
    
    protected function setUp() {
        $talent = $this->getMockBuilder('\Team\Profile\DomainModel\Talent\Talent')->disableOriginalConstructor()->getMock();
        $team = $this->getMockBuilder('\Team\Profile\DomainModel\Team\Team')->disableOriginalConstructor()->getMock();
        $this->membership = Membership::asInvited(1, 'ceo', $talent, $team, true);
    }
    
    function test_changeStatus_invalidArgument_returnErorrMessage() {
        $response = $this->membership->changeStatus('bad status');
        $this->assertInstanceOf('\Resources\ErrorMessage', $response);
print_r($response->toArray());
    }
    function test_changeStatus_fromInvited_shouldChangeStatus() {
        $this->assertEquals('invited', $this->membership->getStatus());
//        $status = 'active';
//        $status = 'cancel';
        $status = 'reject';
        $response = $this->membership->changeStatus($status);
        $this->assertTrue($response);
        $this->assertEquals($status, $this->membership->getStatus());
    }
    function test_changeStatus_invalidTransitionFromInvited_returnErorrMessage() {
        $this->assertEquals('invited', $this->membership->getStatus());
//        $status = 'resign';
        $status = 'remove';
        $response = $this->membership->changeStatus($status);
        $this->assertInstanceOf('\Resources\ErrorMessage', $response);
print_r($response->toArray());
        
    }
    function test_changeStatus_fromActive_shouldChangeStatus() {
        $this->membership->changeStatus('active');
        $this->assertEquals('active', $this->membership->getStatus());
//        $status = 'resign';
        $status = 'remove';
        $response = $this->membership->changeStatus($status);
        $this->assertTrue($response);
        $this->assertEquals($status, $this->membership->getStatus());
    }
    function test_changeStatus_invalidTransitionFromActive_returnErorrMessage() {
        $this->membership->changeStatus('active');
        $this->assertEquals('active', $this->membership->getStatus());
//        $status = 'active';
//        $status = 'reject';
        $status = 'cancel';
        $response = $this->membership->changeStatus($status);
        $this->assertInstanceOf('\Resources\ErrorMessage', $response);
print_r($response->toArray());
        
    }
}

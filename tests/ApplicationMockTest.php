<?php
/*

namespace Herzen\Admission\Orm\Tests;


use Herzen\Admission\Orm\ApplicationMock;

class ApplicationMockTest extends \PHPUnit_Framework_TestCase {
    protected $entrant;
    protected $application;

    public function setUp() {

        $this->entrant = new EntrantMock("Иванов Иван Иванович");

        $this->application = new ApplicationMock($this->entrant);

    }

    function testConstructor() {
        $this->assertEquals($this->application->getEntrant(), $this->entrant);
    }

    function testNumber() {
        $this->assertNotEmpty($this->application->getNumber());
    }

    function testDefaultEnrollable() {
        $this->assertFalse($this->application->isEnrollable());
    }

    function testDefaultEnrolled() {
        $this->assertFalse($this->application->isEnrolled());
    }

    function testDefaultIsDismissed() {
        $this->assertFalse($this->application->isDismissed());
    }

    function testIsEnrollable() {
        $this->assertTrue($this->application->setEnrollable(true)->isEnrollable());
    }

    function testIsNotEnrollable() {
        $this->assertFalse($this->application->setEnrollable(false)->isEnrollable());
    }

    function testChangeEnrollableFT() {
        $this->assertTrue($this->application->setEnrollable(false)->setEnrollable(true)->isEnrollable());
    }

    function testChangeEnrollableTF() {
        $this->assertFalse($this->application->setEnrollable(true)->setEnrollable(false)->isEnrollable());
    }


    function testEnrollNotEnrollable() {
        $this->assertFalse($this->application->setEnrollable(false)->enroll()->isEnrolled());
    }

    function testEnrollEnrollable() {
        $this->assertTrue($this->application->setEnrollable(true)->enroll()->isEnrolled());
    }

    function testCancelEnrollmentOfEnrollable() {
        $this->assertFalse($this->application->setEnrollable(true)->enroll()->cancelEnrollment()->isEnrolled());
    }

    function testCancelEnrollmentOfEnrollableIsEnrollable() {
        $this->assertTrue($this->application->setEnrollable(true)->enroll()->cancelEnrollment()->isEnrollable());
    }


    function testDismiss() {
        $this->assertTrue($this->application->dismiss()->isDismissed());
    }

    function testIsDismissedEnrolled() {
        $this->assertTrue($this->application->setEnrollable(true)->enroll()->dismiss()->isDismissed());
    }

    function testIsEnrolledDismissed() {
        $this->assertFalse($this->application->setEnrollable(true)->enroll()->dismiss()->isEnrolled());
    }

}
*/

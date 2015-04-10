<?php

namespace Herzen\Admission\Orm\Tests;

use Herzen\Admission\Orm\EntrantMockGenerator;
use Herzen\Admission\Orm\EntrantInterface;
use Herzen\Admission\Orm\EntrantMock;

class EntrantMockGeneratorTest extends \PHPUnit_Framework_TestCase {

    protected $entrantGenerator;
    protected $entrant;
    protected $entrantsCount = 10;
    protected $entrants;

    public function setUp() {

        $this->entrantGenerator = new EntrantMockGenerator();

        $this->entrant = $this->entrantGenerator->generateOne();

        $this->entrants = $this->entrantGenerator->generate($this->entrantsCount);
    }

    function testGeneratedEntrantIsEntrantInterface() {
        $this->assertTrue($this->entrant instanceOf EntrantInterface);
    }
    function testGeneratedEntrantIsEntrantMock() {
        $this->assertTrue($this->entrant instanceOf EntrantMock);
    }
    function testGeneratedEntrantGender() {
        $this->assertNotEmpty($this->entrant->getGender());
    }
    function testGeneratedEntrantLastname() {
        $this->assertNotEmpty($this->entrant->getLastname());
    }
    function testGeneratedEntrantFirstname() {
        $this->assertNotEmpty($this->entrant->getFirstname());
    }

    function testGeneratedEntrantsCount() {
        $this->assertEquals(count($this->entrants), $this->entrantsCount);
    }
    function testGeneratedEntrantsAreEntrantInterface() {
        foreach ($this->entrants as $entrant) {
            $this->assertTrue($entrant instanceOf EntrantInterface);
        }
    }
    function testGeneratedEntrantsAreEntrantMock() {
        foreach ($this->entrants as $entrant) {
            $this->assertTrue($entrant instanceOf EntrantMock);
        }
    }

}

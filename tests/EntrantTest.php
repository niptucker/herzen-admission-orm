<?php

namespace Herzen\Admission\Orm\Tests;

use Herzen\Admission\Orm\Entrant;
use Herzen\Admission\Orm\Tests\Bootstrapper;

class EntrantTest extends \PHPUnit_Framework_TestCase {

    protected $em;
    protected $entrant;

    public function setUp() {
        $this->em = Bootstrapper::getEntityManager();
        $this->entrant = $this->em->find("Herzen\Admission\Orm\Entrant", 96935);
    }

    public function testLastname() {
        $this->assertEquals($this->entrant->getLastname(), "Кавайный");
    }
}
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

    public function testUuid() {
        $this->assertEquals($this->entrant->getUuid(), "782d1d44-23ff-4854-befa-ebcfb65662a6");
    }

    public function testFindByUuid() {
        $entrantRepository = $this->em->getRepository("Herzen\Admission\Orm\Entrant");
        $entrant = $entrantRepository->findOneByUuid("782d1d44-23ff-4854-befa-ebcfb65662a6");
        $this->assertEquals($entrant, $this->entrant);
    }
}
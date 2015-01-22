<?php

namespace Herzen\Admission\Tests;

use Herzen\Admission\Entrant;

class EntrantTest extends \PHPUnit_Framework_TestCase {

    protected $em;

    public function setUp() {
        $this->em = EntityManagerHelper::getEntityManager();
    }

    public function testDefault() {

        $entrant = $this->em->find("Herzen\Admission\Entrant", 96935);
        $this->assertEquals($entrant->getLastname(), "Кавайный");

    }
}
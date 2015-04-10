<?php

namespace Herzen\Admission\Orm\Tests;

use Herzen\Admission\Orm\EntrantMock;

class EntrantMockTest extends \PHPUnit_Framework_TestCase {

    protected $lastname;
    protected $firstname;
    protected $patronymic;
    protected $gender;

    protected $entrant;

    protected $application;

    public function setUp() {

        $this->lastname = "Иванов";
        $this->firstname = "Иван";
        $this->patronymic = "Иванович";
        $this->gender = "м";

        $this->entrant = new EntrantMock($this->gender, $this->lastname, $this->firstname, $this->patronymic);

    }

    function testConstructorGender() {
        $this->assertEquals($this->entrant->getGender(), $this->gender);
    }
    function testConstructorLastname() {
        $this->assertEquals($this->entrant->getLastname(), $this->lastname);
    }
    function testConstructorFirstname() {
        $this->assertEquals($this->entrant->getFirstname(), $this->firstname);
    }
    function testConstructorPatronymic() {
        $this->assertEquals($this->entrant->getPatronymic(), $this->patronymic);
    }

}

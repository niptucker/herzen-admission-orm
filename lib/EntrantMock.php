<?php

namespace Herzen\Admission\Orm;

use Herzen\Utils\ColorsUniversal;
use Herzen\Utils\Colors;

class EntrantMock implements EntrantInterface {

    protected static $lastId = 0;

    protected $id;
    protected $lastname;
    protected $firstname;
    protected $patronymic;
    protected $gender;

    protected $applications = array();

    protected static $entrants = array();

    public static function getInstance($id, $gender, $lastname, $firstname, $patronymic) {
        if (!isset(static::$entrants[$id])) {
            static::$entrants[$id] = new EntrantMock($gender, $lastname, $firstname, $patronymic, $id);
        }

    return static::$entrants[$id];
    }

    public static function getEntrants() {
        return static::$entrants;
    }

    public function __construct($gender, $lastname, $firstname, $patronymic, $id = null) {
        if ($id) {
            $this->id = $id;
        } else {
            $this->id = ++self::$lastId;
        }

        $this->gender = $gender;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->patronymic = $patronymic;
    }

    public function getFIO() {
        return trim($this->lastname . " " . $this->firstname . " " . $this->patronymic);
    }

    public function getId() {
        return $this->id;
    }
    public function getLastname() {
        return $this->lastname;
    }
    public function getFirstname() {
        return $this->firstname;
    }
    public function getPatronymic() {
        return $this->patronymic;
    }
    public function getGender() {
        return $this->gender;
    }

    public function __toString() {
        return 'Аб. #'
            . $this->id
            . ' '
            . $this->gender
            . ' '
            . $this->getFIO()
            . ''
            . ($this->isEnrolled() ? ' (зачислен с '
                . (new ColorsUniversal())->getColoredString($this->getEnrollApplication()->getPriority()
                    , $this->getEnrollApplication()->getPriorityFColor()
                    , $this->getEnrollApplication()->getPriorityBColor()
                    )
                . ' п в этап '
                . $this->getEnrollApplication()->getEnrollStage()
                . ' на КГ #' . $this->getEnrollApplication()->getCompetitiveGroup()->getId()
                . ')' : '')
            . '';
    }

    public function echoFull() {
        return ''
            . $this
            . "\n"
            . implode("\n", $this->applications)
            . '';
    }


    /**
     * Add application
     *
     * @param ApplicationInterface $application
     */
    public function addApplication(ApplicationInterface $application)
    {
        $this->applications[] = $application;

        return $this;
    }

    /**
     * Remove application
     *
     * @param ApplicationInterface $application
     */
    public function removeApplication(ApplicationInterface $application)
    {
        throw new Exception("Not implemented yet");

        // $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return array
     */
    public function getApplications()
    {
        return $this->applications;
    }

    public function isEnrolled() {
        foreach ($this->applications as $application) {
            if ($application->isEnrolled()) {
                return true;
            }
        }
        return false;
    }

    public function hasApplication($competitiveGroup) {
        foreach ($this->applications as $application) {
            if ($application->getCompetitiveGroup() == $competitiveGroup) {
                return true;
            }
        }
        return false;
    }

    public function setEnrollApplication($application) {
        $this->enrollApplication = $application;

        foreach ($this->applications as $app) {
            if ($app != $application) {
                // var_dump("Dis: " . $app->getNumber() . ' _ ' . $application->getNumber(), $app != $application);
                $app->setEnrollable(false);
            }
        }

        return $this;
    }

    public function unsetEnrollApplication() {
        $this->enrollApplication = null;

        return $this;
    }

    public function getEnrollApplication() {
        return $this->enrollApplication;
    }
}

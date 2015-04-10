<?php

namespace Herzen\Admission\Orm;

use Herzen\Utils\ColorsUniversal;

class ApplicationMock implements ApplicationInterface, PriorityApplicationInterface {

    protected static $lastNumber = 0;

    protected static $maxPriority = 1;

    protected $entrant;

    protected $competitiveGroup;

    protected $number;

    protected $scoresum;

    protected $isEnrollable = false;

    protected $isEnrolled = false;

    protected $isDismissed = false;

    protected $priority;

    protected $enrollStage;

    public function __construct($entrant, $competitiveGroup, $priority = null, $number = null)
    {
        $this->entrant = $entrant;
        $this->competitiveGroup = $competitiveGroup;
        $this->priority = $priority;

        if ($this->priority > static::$maxPriority) {
            static::$maxPriority = $this->priority;
        }

        if ($number) {
            $this->number = $number;
        } else {
            $this->number = ++self::$lastNumber;
        }

        $this->entrant->addApplication($this);
        $this->competitiveGroup->addApplication($this);

        $this->isEnrollable = true;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getScoresum()
    {
        return $this->scoresum;
    }

    public function getEntrant() {
        return $this->entrant;
    }

    public function getEnrollStage() {
        return $this->enrollStage;
    }

    public function getCompetitiveGroup() {
        return $this->competitiveGroup;
    }

    public function __toString()
    {
        return ''
            . (new ColorsUniversal())->getColoredString(''
                    . "З №" . $this->getNumber()
                    . ', п'
                    . ', сумма - ' . $this->getScoresum() . ' баллов '
                    . ((new ColorsUniversal())->getColoredString($this->getPriority()
                                , $this->getPriorityFColor()
                                , $this->getPriorityBColor()
                                ))
                    . ", " . $this->entrant
                    . ", КГ " . $this->competitiveGroup->getId()
                    . ". "
                    . ($this->isEnrolled
                        ? ('Зачислен по '
                            . (new ColorsUniversal())->getColoredString($this->getPriority()
                                , $this->getPriorityFColor()
                                , $this->getPriorityBColor()
                                )
                            . ' п в этап '
                            . $this->getEnrollStage()
                            . ' на КГ #'
                            . $this->competitiveGroup->getId()
                            . '')
                        : '')
                    . ''
                , $this->isEnrollable() ? "white" : "dark_gray"
                , $this->isEnrolled ? $this->getPriorityFColor() : "black"
            );
    }

    public function setEnrollable($isEnrollable)
    {
        $this->isEnrollable = $isEnrollable;

        return $this;
    }

    public function isEnrollable()
    {
        return $this->isEnrollable;
    }


    public function enrollWithPriority($stage = null) {
        $this->enroll($stage);
    }

    public function enroll($stage = null)
    {
        if ($this->isEnrollable($stage) && !$this->isDismissed()) {
            $this->isEnrolled = true;
            $this->enrollStage = $stage;
            $this->entrant->setEnrollApplication($this);
        }


        return $this;
    }

    public function cancelEnrollment()
    {
        $this->isEnrolled = false;
        $this->entrant->unsetEnrollApplication();

        return $this;
    }

    public function isEnrolled() {
        return $this->isEnrolled;
    }

    public function dismiss()
    {
        $this->cancelEnrollment();
        $this->isDismissed = true;

        return $this;
    }

    public function cancelDismission()
    {
        $this->isDismissed = false;

        return $this;
    }

    public function isDismissed() {
        return $this->isDismissed;
    }

    public function getPriority() {
        return $this->priority;
    }

    protected $priorityColors = array("1" => "green", "2" => "yellow", "3" => "red");

    public function getPriorityFColor() {
        return isset($this->priorityColors[$this->priority]) ? $this->priorityColors[$this->priority] : 'purple';
    }

    public function getPriorityBColor() {
        return 'black';
    }

    public function setPriority($priority) {
        $this->priority = $priority;

        return $this;
    }

    public function setScoresum($scoresum) {
        $this->scoresum = $scoresum;

        return $this;
    }

    public static function getMaxPriority() {
        return static::$maxPriority;
    }
}

<?php

namespace Herzen\Admission\Orm;

use Herzen\Utils\ColorsUniversal;

class ApplicationMock extends Mock implements ApplicationInterface, PriorityApplicationInterface {

    protected static $lastNumber = 0;

    protected static $maxPriority = 1;

    protected $entrant;

    protected $competitiveGroup;

    protected $number;

    protected $pointsTotal;

    protected $isEnrollable = false;

    protected $isEnrolled = false;

    protected $isDismissed = false;

    protected $priority;

    protected $comment = '';

    protected $enrollmentStage;

    protected $isQuota = false;

    protected $isTarget = false;

    protected $isNoexams = false;

    protected $competitiveListPosition;

    protected $enrollmentListPosition;


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

    public function getId()
    {
        return $this->number;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getPointsTotal()
    {
        return $this->pointsTotal;
    }

    public function getEntrant() {
        return $this->entrant;
    }

    public function getEnrollmentStage() {
        return $this->enrollmentStage;
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
                    . ', сумма - ' . $this->getPointsTotal() . ' баллов '
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
                            . $this->getEnrollmentStage()
                            . ' на КГ #'
                            . $this->competitiveGroup->getId()
                            . '')
                        : '')
                    . ''
                , $this->isEnrollable() ? "white" : "gray"
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
        if ($this->isEnrollable() && !$this->isDismissed()) {
            $this->isEnrolled = true;
            $this->enrollmentStage = $stage;
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


    public function setComment($comment) {
        $this->comment = $comment;

        return $this;
    }

    public function getComment() {
        return $this->comment;
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

    public function setPointsTotal($pointsTotal) {
        $this->pointsTotal = $pointsTotal;

        return $this;
    }

    public static function getMaxPriority() {
        return static::$maxPriority;
    }


    public function setIsQuota($isQuota) {
        $this->isQuota = $isQuota;

        return $this;
    }

    public function getIsQuota() {
        return $this->isQuota;
    }

    public function setIsTarget($isTarget) {
        $this->isTarget = $isTarget;

        return $this;
    }

    public function getIsTarget() {
        return $this->isTarget;
    }

    public function setIsNoexams($isNoexams) {
        $this->isNoexams = $isNoexams;

        return $this;
    }

    public function getIsNoexams() {
        return $this->isNoexams;
    }

    public function getEnrollmentListPosition() {
        return $this->enrollmentListPosition;
    }

    public function setEnrollmentListPosition($enrollmentListPosition) {
        return $this->enrollmentListPosition = $enrollmentListPosition;
    }

    public function getCompetitiveListPosition() {
        return $this->competitiveListPosition;
    }

    public function setCompetitiveListPosition($competitiveListPosition) {
        return $this->competitiveListPosition = $competitiveListPosition;
    }

}

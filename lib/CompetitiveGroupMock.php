<?php

namespace Herzen\Admission\Orm;

use Herzen\Utils\RandomUtils;

/**
 * Competitive Group Mock
 */
class CompetitiveGroupMock extends Mock implements CompetitiveGroupInterface {
    // , EnrollableByPriorityInterface

    protected static $lastId = 0;

    protected $id;

    protected $name;

    protected $plan;
    protected $plans = array();

    protected $applications;

    protected $color;

    protected $planQuota;

    protected $planTarget;


    protected static $cgs = array();
    public static function getInstance($id, $name, $plan, $ref_abit_eedufinancing, $ref_abit_eeduform, $ref_abit_edugrade) {
        if (!isset(static::$cgs[$id])) {
            static::$cgs[$id] = new CompetitiveGroupMock($name, $id, $plan, $ref_abit_eedufinancing, $ref_abit_eeduform, $ref_abit_edugrade);
        }

        return static::$cgs[$id];
    }
    public function getCompetitiveGroups() {
        return static::$cgs;
    }

    public function __construct($name, $id = null, $plan = null, $ref_abit_eedufinancing = null, $ref_abit_eeduform = null, $ref_abit_edugrade = null) {
        if ($id) {
            $this->id = $id;
        } else {
            $this->id = ++self::$lastId;
        }

        $this->name = $name;
        $this->plan = $plan;
        $this->plans[1] = ceil($this->plan*0.8);
        $this->plans[2] = $this->plan - $this->plans[1];

        $this->ref_abit_eedufinancing = $ref_abit_eedufinancing;
        $this->ref_abit_eeduform = $ref_abit_eeduform;
        $this->ref_abit_edugrade = $ref_abit_edugrade;

        #todo: перенести в наследника
        $this->color = RandomUtils::getRandomColor();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getRefAbitEedufinancing()
    {
        return $this->ref_abit_eedufinancing;
    }
    public function getRefAbitEeduform()
    {
        return $this->ref_abit_eeduform;
    }
    public function getRefAbitEdugrade()
    {
        return $this->ref_abit_edugrade;
    }

    public function enroll() {
        throw new Exception("Not impl");
    }

    public function enrollWithPriority($priority, $stage) {
        $this->calcPlan();

        $plan = $this->getPlan($stage) - count($this->getEnrolledApplications());

        // echo ">>>$this, $plan\n";
        $applicationIndex = 1;
        foreach ($this->applications as $application) {
            if ($application->getPriority() == $priority) {
                if ($applicationIndex <= $plan) {
                    if ($application->isEnrollable($stage)) {
                        $application->enrollWithPriority($stage);
                        $applicationIndex++;
                    }
                }
            }
        }
    }

    public function __toString() {
        return ''
            . 'КГ '
            . $this->getId()
            . ' '
            . $this->getName()
            . ', план - '
            . $this->getPlan()
            . ' = '
            . $this->getPlan(1)
            . "+"
            . $this->getPlan(2)
            . ' из '
            . count($this->applications)
            . '';
    }

    public function echoFull() {
        return $this
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

    public function getEnrolledApplications(EnrollmentStageInterface $stage = null)
    {
        $enrolledApps = array_filter($this->applications, function($app) {
                return $app->isEnrolled();
            });

        if ($stage) {
            $enrolledApps = array_filter($enrolledApps, function($app) use ($stage) {
                return $app->getEnrollmentStage() == $stage;
            });
        }

        return $enrolledApps;
    }

    public function getEnrollableApplications()
    {
        return array_filter($this->applications, function($app) {
                return $app->isEnrollable();
            });
    }

    /**
     * @todo Add to Interface
     */
    public function getPlan($stage = null) {
        if (isset($this->plans[$stage])) {
            return $this->plans[$stage];
        } else {
            return $this->plan;
        }
    }

    public function getPlanFst() {
        return $this->plans[1];
    }

    public function getPlanSnd() {
        return $this->plans[2];
    }

    public function calcPlan() {
        if (is_null($this->plan)) {
            $this->plan = rand(1, floor(count($this->getEnrollableApplications())*0.5));
        }

        return $this;
    }

    public function getColor() {
        return $this->color;
    }

    public function setPlanQuota($planQuota) {
        $this->planQuota = $planQuota;

        return $this;
    }

    public function getPlanQuota() {
        return $this->planQuota;
    }

    public function setPlanTarget($planTarget) {
        $this->planTarget = $planTarget;

        return $this;
    }

    public function getPlanTarget() {
        return $this->planTarget;
    }

}

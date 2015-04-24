<?php

namespace Herzen\Admission\Orm;

abstract class BenefitEnrollmentStage extends EnrollmentStage {

    protected $name = "Льготный этап";

    protected $alias = "benefit";

    public function matchCondition(ApplicationInterface $application) {
        return $application->getIsQuota() || $application->getIsTarget() || $application->getIsNoexams();
    }

}

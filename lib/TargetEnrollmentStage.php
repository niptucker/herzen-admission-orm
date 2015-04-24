<?php

namespace Herzen\Admission\Orm;

class TargetEnrollmentStage extends BenefitEnrollmentStage {

    protected $name = "Льготный этап (целевые)";

    protected $alias = "benefit-target";

    public function matchCondition(ApplicationInterface $application) {
        return $application->getIsTarget();
    }

    protected function getMaxCapacity(ApplicationInterface $application) {
        return $application->getCompetitiveGroup()->getPlanTarget();
    }

}

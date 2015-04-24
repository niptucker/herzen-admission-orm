<?php

namespace Herzen\Admission\Orm;

class QuotaEnrollmentStage extends BenefitEnrollmentStage {

    protected $name = "Льготный этап (квота)";

    protected $alias = "benefit-quota";

    public function matchCondition(ApplicationInterface $application) {
        return $application->getIsQuota();
    }

    protected function getMaxCapacity(ApplicationInterface $application) {
        return $application->getCompetitiveGroup()->getPlanQuota();
    }

}

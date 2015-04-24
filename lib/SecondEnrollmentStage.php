<?php

namespace Herzen\Admission\Orm;

class SecondEnrollmentStage extends CommonEnrollmentStage {

    protected $name = "Общий конкурс, 2 этап";

    protected $alias = "common-2";

    public function matchCondition(ApplicationInterface $application) {
        return !$application->getIsQuota() && !$application->getIsTarget() && !$application->getIsNoexams();
    }

    protected function getMaxCapacity(ApplicationInterface $application) {
        return parent::getMaxCapacity($application) - count($application->getCompetitiveGroup()->getEnrolledApplications(new FirstEnrollmentStage()));
    }

}

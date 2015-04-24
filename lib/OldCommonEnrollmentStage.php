<?php

namespace Herzen\Admission\Orm;

class OldCommonEnrollmentStage extends CommonEnrollmentStage {

    protected $name = "Общий конкурс";
    
    protected $alias = "common";

    public function matchCondition(ApplicationInterface $application) {
        return !$application->getIsQuota() && !$application->getIsTarget() && !$application->getIsNoexams();
    }

    protected function getMaxCapacity(ApplicationInterface $application) {
        return $application->getCompetitiveGroup()->getPlanTarget();
    }

    protected function getCurrentOccupancy(ApplicationInterface $application) {
        return count($application->getCompetitiveGroup()->getEnrolledApplications($this));
    }

}

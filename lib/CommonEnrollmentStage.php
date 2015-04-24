<?php

namespace Herzen\Admission\Orm;

class CommonEnrollmentStage extends EnrollmentStage {

    protected $name = "Общий конкурс";

    protected $alias = "common";

    public function matchCondition(ApplicationInterface $application) {
        return !$application->getIsQuota() && !$application->getIsTarget() && !$application->getIsNoexams();
    }

    protected function getMaxCapacity(ApplicationInterface $application) {
        // return 10;
        $x = $application->getCompetitiveGroup()->getPlan();
        // var_dump("Plan: $x;");
        $x -= count($application->getCompetitiveGroup()->getEnrolledApplications(new QuotaEnrollmentStage()));
        // var_dump("PlanAfterQ: $x;");
        $x -= count($application->getCompetitiveGroup()->getEnrolledApplications(new TargetEnrollmentStage()));
        // var_dump("PlanAfterT: $x;");
        $x -= count($application->getCompetitiveGroup()->getEnrolledApplications(new NoExamEnrollmentStage()));
        // var_dump("PlanAfterNE: $x;");
        return $x;
    }

    protected function getCurrentOccupancy(ApplicationInterface $application) {
        return count($application->getCompetitiveGroup()->getEnrolledApplications($this));
    }

}

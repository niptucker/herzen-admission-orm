<?php

namespace Herzen\Admission\Orm;

class NoExamEnrollmentStage extends BenefitEnrollmentStage {

    protected $name = "Льготный этап (без экзаменов)";

    protected $alias = "benefit-noexam";

    public function matchCondition(ApplicationInterface $application) {
        return $application->getIsNoexams();
    }

    protected function getMaxCapacity(ApplicationInterface $application) {
        return $application->getCompetitiveGroup()->getPlan();
    }

}

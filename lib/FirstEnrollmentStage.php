<?php

namespace Herzen\Admission\Orm;

class FirstEnrollmentStage extends CommonEnrollmentStage {

    protected $name = "Общий конкурс, 1 этап";

    protected $alias = "common-1";

    const SHARE = 0.8;

    public function matchCondition(ApplicationInterface $application) {
        return parent::matchCondition($application);
    }

    protected function getMaxCapacity(ApplicationInterface $application) {
        // if ($application->getCompetitiveGroup()->getId() == 7155) { 
        //     var_dump(parent::getMaxCapacity($application));
        // }
        return ceil(parent::getMaxCapacity($application) * static::SHARE);
    }

}

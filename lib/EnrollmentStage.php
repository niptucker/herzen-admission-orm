<?php

namespace Herzen\Admission\Orm;

abstract class EnrollmentStage implements EnrollmentStageInterface {

    protected $name;

    protected $alias;
    
    public function getName() {
        return $this->name;
    }
    
    public function getAlias() {
        return $this->alias;
    }

    public function allowsEnrollment(ApplicationInterface $application) {
        // if ($this->alias == "common-1" || $this->alias == "common") {
            // var_dump("App: $application, " . $this->matchCondition($application) . ':' . $this->getMaxCapacity($application));
        // }
        return $this->matchCondition($application) && $this->hasPlace($application);
    }

    public function hasPlace(ApplicationInterface $application) {
        return $this->getCurrentOccupancy($application) < $this->getMaxCapacity($application);
    }

    abstract protected function getMaxCapacity(ApplicationInterface $application);

    // protected function getMaxCapacity(ApplicationInterface $application) {
    //     return 10;
    // }

    protected function getCurrentOccupancy(ApplicationInterface $application) {
        return count($application->getCompetitiveGroup()->getEnrolledApplications($this));
    }
}

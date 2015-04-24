<?php

namespace Herzen\Admission\Orm;

interface EnrollmentStageInterface {

    public function allowsEnrollment(ApplicationInterface $application);
    public function matchCondition(ApplicationInterface $application);
    public function hasPlace(ApplicationInterface $application);
}

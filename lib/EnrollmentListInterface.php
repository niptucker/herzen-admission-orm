<?php

namespace Herzen\Admission\Orm;

interface EnrollmentListInterface {

    public function getApplications();

    public function getApplicationPosition(ApplicationInterface $application);

    public function getApplicationCount();
    
}

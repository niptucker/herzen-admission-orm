<?php

namespace Herzen\Admission\Orm;

interface EntrantInterface {

    public function addApplication(ApplicationInterface $application);

    public function removeApplication(ApplicationInterface $application);

    public function getApplications();

    public function isEnrolled();

}

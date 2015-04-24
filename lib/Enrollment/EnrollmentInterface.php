<?php

namespace Herzen\Admission\Orm\Enrollment;

use Herzen\Admission\Orm\EnrollmentListInterface;
use Herzen\Admission\Orm\EnrollmentStageInterface;

interface EnrollmentInterface {

    public function __construct(EnrollmentListInterface $list);

    public function getEnrollmentList();

    // public function getAllApplications();

    // public function getApplicationsToEnroll();

    public function enroll(EnrollmentStageInterface $stage);

    // public function getEnrolledApplications();

}

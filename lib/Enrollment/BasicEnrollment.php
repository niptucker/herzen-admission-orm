<?php

namespace Herzen\Admission\Orm\Enrollment;

use Herzen\Admission\Orm\Enrollment\EnrollmentInterface;
use Herzen\Admission\Orm\CampaignInterface;
use Herzen\Admission\Orm\EnrollmentListInterface;

abstract class BasicEnrollment implements EnrollmentInterface {

    protected $enrollmentList;

    // protected $applications = array();

    // protected $allApplications = array();

    // protected $applicationsToEnroll = array();

    // protected $enrolledApplications = array();

    public function __construct(EnrollmentListInterface $enrollmentList)
    {
        $this->enrollmentList = $enrollmentList;
    }

    public function getEnrollmentList() {
        return $this->enrollmentList;
    }

    public function getApplications()
    {
        return $this->enrollmentList->getApplications();
    }

    // public function getAllApplications()
    // {
    //     return $this->allApplications;
    // }

    // public function getApplicationsToEnroll()
    // {
    //     return $this->applicationsToEnroll;
    // }

    // public function getEnrolledApplications()
    // {
    //     return $this->enrolledApplications;
    // }

}
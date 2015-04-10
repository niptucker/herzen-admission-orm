<?php

namespace Herzen\Admission\Orm\Enrollment;

use Herzen\Admission\Orm\Enrollment\EnrollmentInterface;
use Herzen\Admission\Orm\CampaignInterface;

abstract class BasicEnrollment implements EnrollmentInterface {

    protected $campaign;

    // protected $allApplications = array();

    // protected $applicationsToEnroll = array();

    // protected $enrolledApplications = array();

    public function __construct(CampaignInterface $campaign)
    {
        $this->campaign = $campaign;
    }

    public function getCampaign() {
        return $this->campaign;
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
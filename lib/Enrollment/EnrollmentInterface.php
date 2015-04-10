<?php

namespace Herzen\Admission\Orm\Enrollment;

use Herzen\Admission\Orm\CampaignInterface;

interface EnrollmentInterface {

    public function __construct(CampaignInterface $campaign);

    public function getCampaign();

    // public function getAllApplications();

    // public function getApplicationsToEnroll();

    public function enroll($stage);

    // public function getEnrolledApplications();

}

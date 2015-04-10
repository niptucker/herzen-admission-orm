<?php

namespace Herzen\Admission\Orm;

use Herzen\Admission\Orm\Enrollment\EnrollmentInterface;
use Herzen\Admission\Orm\CompetitiveGroupMockGenerator;

/**
 * Admission Campaign Mock
 */
class CampaignRealMock implements CampaignInterface {

    protected $competitiveGroups = array();

    public function __construct() {
    }

    public function addCompetitiveGroup($competitiveGroup) {
        $this->competitiveGroups[] = $competitiveGroup;
    }

    public function getCompetitiveGroups() {
        return $this->competitiveGroups;
    }

    /**
     * @todo to Interface
     */
    public function getMaxPriority() {
        return ApplicationMock::getMaxPriority();
    }

}

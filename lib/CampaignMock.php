<?php

namespace Herzen\Admission\Orm;

use Herzen\Admission\Orm\Enrollment\EnrollmentInterface;
use Herzen\Admission\Orm\CompetitiveGroupMockGenerator;

/**
 * Admission Campaign Mock
 */
class CampaignMock implements CampaignInterface {

    protected $competitiveGroups = array();

    public function __construct() {
        $generator = (new CompetitiveGroupMockGenerator())->getCompetitiveGroup();

        foreach($generator as $competitiveGroup) {
            $this->competitiveGroups[] = $competitiveGroup;
        }


        // $generator = new CompetitiveGroupMockGenerator();

        // foreach($generator->generateAll() as $competitiveGroup) {
        //     $this->competitiveGroups[] = $competitiveGroup;
        // }
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

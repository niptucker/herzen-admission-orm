<?php

namespace Herzen\Admission\Orm;

use Herzen\Admission\Orm\Enrollment\EnrollmentInterface;
use Herzen\Admission\Orm\CompetitiveGroupMockGenerator;

/**
 * Admission Campaign Mock
 */
class CampaignMock extends Mock implements CampaignInterface {

    protected $competitiveGroups = array();

    protected $id;

    public function __construct() {
        $this->id = 1;

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

    public function getId() {
        return $this->id;
    }

    /**
     * @todo to Interface
     */
    public function getMaxPriority() {
        return ApplicationMock::getMaxPriority();
    }

}

<?php

namespace Herzen\Admission\Orm;

class CompetitiveList implements CompetitiveListInterface {

    protected $applications = array();

    protected static $byCompetitiveGroup = array();

    protected static $byCampaign = array();

    public function __construct(array $applications = array()) {
        $this->applications = $applications;
    }

    public static function createFromCompetitiveGroup(CompetitiveGroupInterface $competitiveGroup) {
        if (isset(static::$byCompetitiveGroup[$competitiveGroup->getId()])) {
            return static::$byCompetitiveGroup[$competitiveGroup->getId()];
        }
        $applications = $competitiveGroup->getApplications();
        $applications = static::sortList($applications);
        $applications = static::setPositions($applications);
        $list = new static($applications);
        static::$byCompetitiveGroup[$competitiveGroup->getId()] = $list;
        return $list;
    }

    public static function createFromCampaign(CampaignInterface $campaign) {
        if (isset(static::$byCampaign[$campaign->getId()])) {
            return static::$byCampaign[$campaign->getId()];
        }
        $applications = array();
        foreach ($campaign->getCompetitiveGroups() as $competitiveGroup) {
            $competitiveGroupList = static::createFromCompetitiveGroup($competitiveGroup);
            $applications = array_merge($applications, $competitiveGroupList->getApplications());
        }
        $applications = static::sortList($applications);
        $list = new static($applications);
        static::$byCampaign[$campaign->getId()] = $list;
        return $list;
    }

    protected static function setPositions($applications) {
        $i = 1;
        $j = 1;
        foreach ($applications as $application) {
            $application->setCompetitiveListPosition($i);
            $i++;


            $application->setEnrollmentListPosition($j);
            if ($application->isEnrollable()) {
                $j++;
            }
        }
        return $applications;
    }

    protected static function sortList($applications) {
        array_multisort(

            array_map(function($app) {
                return $app->getIsNoexams();
            }, $applications)
            , SORT_DESC

            , array_map(function($app) {
                return $app->getIsQuota();
            }, $applications)
            , SORT_DESC

            , array_map(function($app) {
                return $app->getIsTarget();
            }, $applications)
            , SORT_DESC

            , array_map(function($app) {
                return $app->getPointsTotal();
            }, $applications)
            , SORT_DESC

            , array_map(function($app) {
                return $app->getNumber();
            }, $applications)
            , SORT_ASC

            , $applications);

        return $applications;
    }

    public function getApplications() {
        return $this->applications;
    }

    public function getApplicationPosition(ApplicationInterface $application) {
        return array_search($application, $this->applications)+1;
    }

    public function getApplicationCount() {
        return count($this->applications);
    }
    
}

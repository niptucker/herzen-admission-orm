<?php

namespace Herzen\Admission\Orm;

class EnrollmentList implements EnrollmentListInterface {

    protected $applications = array();

    protected $competitiveList;

    public function __construct(CompetitiveListInterface $competitiveList) {
        $this->competitiveList = $competitiveList;
        $this->retrieveApplications();
    }

    protected function retrieveApplications() {
        $this->applications = array_filter($this->competitiveList->getApplications(), function($app) {
                return !$app->isEnrolled() && $app->isEnrollable();
            });

        return $this;

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

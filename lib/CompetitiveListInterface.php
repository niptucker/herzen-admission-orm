<?php

namespace Herzen\Admission\Orm;

interface CompetitiveListInterface {

    public function getApplications();

    public function getApplicationPosition(ApplicationInterface $application);

    public function getApplicationCount();

}

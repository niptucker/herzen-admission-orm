<?php

namespace Herzen\Admission\Orm;

interface ApplicationInterface {

    public function getNumber();

    public function getEntrant();

    public function getCompetitiveGroup();

    public function __toString();

    public function isEnrollable();

    public function isEnrolled();

    public function enroll();

    public function cancelEnrollment();

    public function dismiss();

    public function cancelDismission();

}

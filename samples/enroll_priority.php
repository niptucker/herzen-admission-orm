<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$em = require_once(__DIR__ . "/../bootstrap.php");

use Herzen\Admission\Orm;

/*
$campaign = new Orm\CampaignMock();


$entrantGenerator = new Orm\EntrantMockGenerator();
$applicationMockGenerator = new Orm\ApplicationMockGenerator();

$entrants = $entrantGenerator->generate(20);



foreach ($entrants as $entrant) {
    // var_dump($campaign->getCompetitiveGroups());
    $applications = $applicationMockGenerator->generateRandomCount($entrant, $campaign->getCompetitiveGroups());
}

*/


$campaign = new Orm\CampaignRealMock();

$applicationRealMockGenerator = new Orm\ApplicationRealMockGenerator();

$applications = $applicationRealMockGenerator->getApplications($campaign);

$entrants = Orm\EntrantMock::getEntrants();

foreach ($entrants as $entrant) {
    echo $entrant->echoFull() . "\n\n";
}

foreach ($campaign->getCompetitiveGroups() as $cg) {
    echo $cg->echoFull() . "\n\n";
}

var_dump("Priority enrollment for campaign, max priority is " . $campaign->getMaxPriority());

$priorityEnrollment = new Orm\Enrollment\PriorityEnrollment($campaign);

$priorityEnrollment->enroll(1);


foreach ($entrants as $entrant) {
    echo $entrant->echoFull() . "\n\n";
}

foreach ($campaign->getCompetitiveGroups() as $cg) {
    echo $cg->echoFull() . "\n\n";
}



// $priorityEnrollment->getOrder();

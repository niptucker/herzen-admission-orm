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

if (0) {
    $eCount = 0;
    foreach ($entrants as $entrant) {
        echo sprintf("%6.d", ++$eCount) . ' ' . $entrant->echoFull() . "\n\n";
    }
    die;
}

if (0) {
    $cgCount = 0;
    foreach ($campaign->getCompetitiveGroups() as $cg) {
        echo sprintf("%6.d", ++$cgCount) . ' ' . $cg->echoFull() . "\n\n";
    }
    die;
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

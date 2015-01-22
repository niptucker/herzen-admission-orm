<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$em = require_once(__DIR__ . "/../bootstrap.php");


// find application
$app = $em->find('Herzen\Admission\Application', 86839);

echo "Entrant: ";
echo $app->getEntrant()->getFIO() . "\n";
echo $app->getPointsTotal() . "\n";
echo $app->getOriginal() ? "With original" : "Without original" . "\n";

$apps = $em->find('Herzen\Admission\Entrant', $app->getEntrant()->getId())->getApplications();
foreach ($apps as $app) {
  echo "App: ".$app->getId()."\n";
}

$applications = $em->getRepository("Herzen\Admission\Application");
$enrolled = $applications->findBy(array('status' => 8));
echo "Total enrolled: " . count($enrolled) . "\n";


echo "Cg: ";
echo $app->getCompetitiveGroup()->getId() . ", year " . $app->getCompetitiveGroup()->getReceptionYear()
    . ', faculty ' . $app->getCompetitiveGroup()->getFaculty()->getName()
    . "\n";

echo $app->getL() . "!\n";

$entranceTests = $app->getCompetitiveGroup()->getEducationalProgram()->getEntranceTests();
echo implode("", array_map(function($entranceTest) {
        return $entranceTest->getId() . "\n";
    }, $entranceTests->toArray())) . "\n";

//$applications->

//var_dump($app->getEntrant());

//$app->setStatus(7);
//$em->flush();

//echo "Status is ".$app->getStatus();

//$application = new Application();
//$application->setStatus(5);
//$em->persist($application);
//$em->flush();

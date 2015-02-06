<?php
// cli-config.php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Herzen\Admission\Orm\Bootstrapper;

require_once __DIR__ . "/../bootstrap.php";

$em = Bootstrapper::getEntityManager();

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

ConsoleRunner::run($helperSet);
#$cli->setHelperSet($helperSet);



#return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);

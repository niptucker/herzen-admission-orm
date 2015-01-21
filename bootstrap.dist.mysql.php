<?php

use Doctrine\Common\ClassLoader;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once __DIR__ . "/vendor/autoload.php";

$libRoot = __DIR__ . '/lib';

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array($libRoot), $isDevMode);

// mysql
// database configuration parameters
$conn = require_once "db.connection.mysql.php";

// obtaining the entity manager
$em = EntityManager::create($conn, $config);

return $em;
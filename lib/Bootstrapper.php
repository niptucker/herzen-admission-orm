<?php

namespace Herzen\Admission\Orm;

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;

abstract class Bootstrapper {
    protected static $em;

    public static function getEntityManager() {
        return self::$em;
    }

    public static function bootstrap($connectionFile) {
        $libRoot = __DIR__;

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array($libRoot), $isDevMode);

        // mysql
        // database configuration parameters
        $conn = require_once $connectionFile;

        // obtaining the entity manager
        self::$em = EntityManager::create($conn, $config);
    }
}

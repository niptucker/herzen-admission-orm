<?php

namespace Herzen\Admission\Orm\Tests;

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;

abstract class Bootstrapper {
    protected static $em;

    public static function getEntityManager() {
        if (is_null(self::$em)) {
            self::bootstrap();
        }
        return self::$em;
    }

    protected static function bootstrap() {
        $libRoot = __DIR__;

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array($libRoot), $isDevMode);

        // mysql
        // database configuration parameters
        $conn = require_once __DIR__ . "/../db.connection.mysql.tests.php";

        // obtaining the entity manager
        self::$em = EntityManager::create($conn, $config);
    }
}
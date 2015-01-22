<?php

namespace Herzen\Admission\Tests;

abstract class EntityManagerHelper {

    protected static $em;

    public static function setEntityManager($em) {
        self::$em = $em;
    }

    public static function getEntityManager() {
        return self::$em;
    }
}
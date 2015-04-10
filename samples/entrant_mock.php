<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$em = require_once(__DIR__ . "/../bootstrap.php");

use Herzen\Admission\Orm;
use Herzen\Admission\Orm\EntrantMockGenerator;

$entrantGenerator = new EntrantMockGenerator();
$entrants = $entrantGenerator->generate(10);
var_dump($entrants);
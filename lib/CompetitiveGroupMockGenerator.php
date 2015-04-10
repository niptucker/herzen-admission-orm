<?php

namespace Herzen\Admission\Orm;

use Exception;

/**
 * Competitive Group Mock Generator
 */
class CompetitiveGroupMockGenerator {

    const CG_FILENAME = "/../config/competitive_groups.txt";

    protected $file;

    public function __construct() {
        $filename = realpath(__DIR__ . self::CG_FILENAME);
        if (!file_exists($filename)) {
            throw new Exception("File '$filename' does not exist");
        }
        $this->file = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    public function getCompetitiveGroup() {
        if (!$this->file) {
            return;
        }

        foreach ($this->file as $line) {
            yield new CompetitiveGroupMock($line);
        }
    }


    // public function generateAll() {

    //     $cgs = array();

    //     $competitive_groups = file(__DIR__ . self::CG_FILENAME, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    //     foreach ($competitive_groups as $competitive_group) {
    //         $cgs[] = new CompetitiveGroupMock($competitive_group);
    //     }

    //     return $cgs;
    // }
}

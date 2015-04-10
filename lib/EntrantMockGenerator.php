<?php

namespace Herzen\Admission\Orm;

use Herzen\Utils\RandomUtils;

class EntrantMockGenerator {

    const FILES_PATH = "/../config/";

    const LASTNAMES_FILE_PREFIX = "lastnames_";
    const FIRSTNAMES_FILE_PREFIX = "firstnames_";
    const PATRONYMICS_FILE_PREFIX = "patronymics_";

    protected static $genders = ["м", "ж"];
    protected static $gender_suffixes = ["м" => "m", "ж" => "f"];

    protected $lastnames_m_file;
    protected $lastnames_f_file;
    protected $firstnames_m_file;
    protected $firstnames_f_file;
    protected $patronymic_m_file;
    protected $patronymic_f_file;

    public function generateOne() {

        $gender = RandomUtils::getRandomValueFromArray(static::$genders);
        $gender_suffix = static::$gender_suffixes[$gender];

        $lastnames = file(__DIR__ . static::FILES_PATH . static::LASTNAMES_FILE_PREFIX . $gender_suffix . '.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $firstnames = file(__DIR__ . static::FILES_PATH . static::FIRSTNAMES_FILE_PREFIX . $gender_suffix . '.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $patronymics = file(__DIR__ . static::FILES_PATH . static::PATRONYMICS_FILE_PREFIX . $gender_suffix . '.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        return new EntrantMock($gender,
                RandomUtils::getRandomValueFromArray($lastnames),
                RandomUtils::getRandomValueFromArray($firstnames),
                RandomUtils::getRandomValueFromArray($patronymics)
            );

    }

    public function generate($count) {
        $set = array();
        while ($count-- > 0) {
            $set[] = $this->generateOne();
        }
        return $set;
    }

}

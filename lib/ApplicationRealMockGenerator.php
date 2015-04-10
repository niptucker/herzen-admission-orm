<?php

namespace Herzen\Admission\Orm;

use Herzen\Utils\RandomUtils;

class ApplicationRealMockGenerator {

    const APP_FILENAME = "/../config/applications.csv";

    protected $file;

    public function __construct() {
        $filename = realpath(__DIR__ . self::APP_FILENAME);
        if (!file_exists($filename)) {
            throw new Exception("File '$filename' does not exist");
        }
        $this->file = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    public function getApplications($campaign) {
        if (!$this->file) {
            return;
        }

        $apps = array();

        $head = array_shift($this->file);

        foreach ($this->file as $line) {
            $line_exploded = explode("\t", $line);

            $i=0;
            $app_number = $line_exploded[$i++];

            $entrant_id = $line_exploded[$i++];
            $lastname = $line_exploded[$i++];
            $firstname = $line_exploded[$i++];
            $patronymic = $line_exploded[$i++];
            $gender = $line_exploded[$i++];

            $cg_id = $line_exploded[$i++];
            $cg_name = $line_exploded[$i++];
            $is_original = $line_exploded[$i++];
            $priority = $line_exploded[$i++];
            $scoresum = $line_exploded[$i++];
            $app_count = $line_exploded[$i++];

            $outofcompetition = $line_exploded[$i++];
            $is_noexam = $line_exploded[$i++];
            $ref_abit_target_regions = $line_exploded[$i++];

            $plan = $line_exploded[$i++];
            $planQuota = $line_exploded[$i++];
            $planRegion = $line_exploded[$i++];

            $code = $line_exploded[$i++];

            $ref_abit_eedufinancing = $line_exploded[$i++];
            $ref_abit_eeduform = $line_exploded[$i++];
            $ref_abit_edugrade = $line_exploded[$i++];


            $entrant = EntrantMock::getInstance($entrant_id, $gender, $lastname, $firstname, $patronymic);
            $competitiveGroup = CompetitiveGroupMock::getInstance($cg_id, $cg_name, $plan, $ref_abit_eedufinancing, $ref_abit_eeduform, $ref_abit_edugrade);

            if (!in_array($competitiveGroup, $campaign->getCompetitiveGroups())) {
                $campaign->addCompetitiveGroup($competitiveGroup);
            }

            $app = new ApplicationMock($entrant, $competitiveGroup, $priority, $app_number);
            $app->setEnrollable($is_original);
            $app->setScoresum($scoresum);
            $apps[] = $app;
        }

        return $app;
    }

}

<?php

namespace Herzen\Admission\Orm\Enrollment;

use Herzen\Admission\Orm\Enrollment\EnrollmentInterface;
use Herzen\Admission\Orm\Enrollment\BasicEnrollment;
use PHPerge\Document;

class PriorityEnrollment extends BasicEnrollment implements EnrollmentInterface {

    const PRIORITY_MIN = 1;

    /**
     * @todo Add to interface
     */
    public function filter() {

    }

    public function enroll($stage)
    {
        $maxPriority = $this->campaign->getMaxPriority();
        for ($priority = static::PRIORITY_MIN; $priority <= $maxPriority; $priority++) {

            foreach ($this->campaign->getCompetitiveGroups() as $competitiveGroup) {
                $competitiveGroup->enrollWithPriority($priority, $stage);
            }

            // return;
        }

        $this->getOrder($stage);
    }

    public function getOrder($stage) {

        $doc = new Document("order_common_2014", array(
                "url" => "http://10.0.16.237:8080/verge2/Writer"
            ));

        $doc->setPriority(Document::PRIORITY_LOW);



        //             getRefAbitEedufinancing

        // getRefAbitEdugrade] = (int)$compgroup_eduform_val;

        //             $compgroup_eduform_genitive = $this->kernel->getEnumValue("eduformgen", $form_id);
        //             $fields["EDUFORM_GENITIVE_CASE"] = $compgroup_eduform_genitive;


        // $compgroup_faculty_order_code = $this->kernel->getEnumValue("faculty_order_code", $faculty_id);
        // $compgroup_faculty_dative = $this->kernel->getEnumValue("faculty_dative", $faculty_id);
        // $fields["FACULTY_DATIVE_CASE"] = $compgroup_faculty_dative;


        $order = array();
        $doc->setField("BS", 1);

        foreach ($this->campaign->getCompetitiveGroups() as $competitiveGroup) {

            $doc->setField("EDUFORM", 0);
            $doc->setField("EDUFORM_GENITIVE_CASE", 0);

            $order[] = array(
                "SPECIALITY" => $competitiveGroup->getName()
                , "%" => "2"
                , '$' => "5,1"
            );

            $stud = 0;
            $num = 0;

            $enrolledApps = $competitiveGroup->getEnrolledApplications();

            foreach ($enrolledApps as $application) {
                $order[] = array(
                    "NUM" => ++$num
                    , "STUDNUM" => "15/1-" . ++$stud
                    , "FIO" => $application->getEntrant()->getFIO()
                    , "SCORE" => $application->getScoresum()
                    , "NOTE" => ""
                );
            }
            $doc->setTable("ORDER", $order);

            // header("Content-Type: application/pdf");
            // ../config/
        }
        file_put_contents(__DIR__ . "/../../../www/orders/order1.pdf", $doc->getPDFContent());


    }

}
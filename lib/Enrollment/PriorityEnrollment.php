<?php

namespace Herzen\Admission\Orm\Enrollment;

use Herzen\Admission\Orm\Enrollment\EnrollmentInterface;
use Herzen\Admission\Orm\Enrollment\BasicEnrollment;
use Herzen\Admission\Orm\EnrollmentStageInterface;
use Herzen\Admission\Orm\CompetitiveList;
use Herzen\Admission\Orm\EnrollmentList;
use Herzen\Admission\Orm\ApplicationInterface;
use PHPerge\Document;

class PriorityEnrollment extends BasicEnrollment implements EnrollmentInterface {

    public function enroll(EnrollmentStageInterface $stage)
    {
        foreach ($this->enrollmentList->getApplications() as $application) {
            $enrolledApplication = $this->enrollApplication($stage, $application);
        }
    }

    public function enrollOne(EnrollmentStageInterface $stage)
    {
        foreach ($this->enrollmentList->getApplications() as $application) {
            $enrolledApplication = $this->enrollApplication($stage, $application);
            
            if ($enrolledApplication->isEnrolled()) {
                $enrolledApplication->setComment($enrolledApplication->getComment() . '; ' . "дозачислен");
                return;
            }
        }
    }

    public function enrollApplication(EnrollmentStageInterface $stage, ApplicationInterface $application) {
        if ($stage->allowsEnrollment($application)) {
            if ($application->getEntrant()->isEnrolled()) {
                if ($application->getPriority() < $application->getEntrant()->getEnrollApplication()->getPriority()) {
                    
                    $application->getEntrant()->getEnrollApplication()->setComment("перезачислен по приоритету " . $application->getPriority() . ' ← ' . $application->getEntrant()->getEnrollApplication()->getPriority());
                    $cancelledApplication = $application->getEntrant()->getEnrollApplication()->cancelEnrollment(); // It will unset getEnrollApplication!
                    
                    $application->setComment("перезачислен по приоритету " . $cancelledApplication->getPriority() . ' → ' . $application->getPriority());
                    $application->enroll($stage);
                    // var_dump($cancelledApplication->getId());
                    $this->enrollNextApplication($stage, $cancelledApplication);


                } else {
                    
                    $application->getEntrant()->getEnrollApplication()->setComment("не перезачислен по приоритету " . $application->getPriority() . ' ×← ' . $application->getEntrant()->getEnrollApplication()->getPriority());
                    
                    $application->setComment("не перезачислен по приоритету " . $application->getEntrant()->getEnrollApplication()->getPriority() . ' →× ' . $application->getPriority());

                }
            } else {
                $application->enroll($stage);
            }
        }

        return $application;
    }

    public function enrollNextApplication(EnrollmentStageInterface $stage, ApplicationInterface $application) {
        $competitiveList = CompetitiveList::createFromCompetitiveGroup($application->getCompetitiveGroup());
        $enrollmentList = new EnrollmentList($competitiveList);
        $enrollment = new static($enrollmentList);

        $enrollment->enrollOne($stage);
    } 

    public function getOrder($stage) {

        // $doc = new Document("order_common_2014", array(
        //         "url" => "http://10.0.16.237:8080/verge2/Writer"
        //     ));

        // $doc->setPriority(Document::PRIORITY_LOW);



        // //             getRefAbitEedufinancing

        // // getRefAbitEdugrade] = (int)$compgroup_eduform_val;

        // //             $compgroup_eduform_genitive = $this->kernel->getEnumValue("eduformgen", $form_id);
        // //             $fields["EDUFORM_GENITIVE_CASE"] = $compgroup_eduform_genitive;


        // // $compgroup_faculty_order_code = $this->kernel->getEnumValue("faculty_order_code", $faculty_id);
        // // $compgroup_faculty_dative = $this->kernel->getEnumValue("faculty_dative", $faculty_id);
        // // $fields["FACULTY_DATIVE_CASE"] = $compgroup_faculty_dative;


        // $order = array();
        // $doc->setField("BS", 1);

        // foreach ($this->campaign->getCompetitiveGroups() as $competitiveGroup) {

        //     $doc->setField("EDUFORM", 0);
        //     $doc->setField("EDUFORM_GENITIVE_CASE", 0);

        //     $order[] = array(
        //         "SPECIALITY" => $competitiveGroup->getName()
        //         , "%" => "2"
        //         , '$' => "5,1"
        //     );

        //     $stud = 0;
        //     $num = 0;

        //     $enrolledApps = $competitiveGroup->getEnrolledApplications();

        //     foreach ($enrolledApps as $application) {
        //         $order[] = array(
        //             "NUM" => ++$num
        //             , "STUDNUM" => "15/1-" . ++$stud
        //             , "FIO" => $application->getEntrant()->getFIO()
        //             , "SCORE" => $application->getPointsTotal()
        //             , "NOTE" => ""
        //         );
        //     }
        //     $doc->setTable("ORDER", $order);

        //     // header("Content-Type: application/pdf");
        //     // ../config/
        // }
        // file_put_contents(__DIR__ . "/../../../www/orders/order1.pdf", $doc->getPDFContent());


    }

}
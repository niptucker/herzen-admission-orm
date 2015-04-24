<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$em = require_once(__DIR__ . "/../bootstrap.php");

use Herzen\Admission\Orm;

require_once('/var/wwwnext/entrance/src/services/cli/misc.inc.php');

if (!empty($_POST["dump"])) {
    require_once('/var/wwwnext/entrance/src/services/cli/cli.inc.php');

    function dump() {
        global $kernel;

        $query = 'SELECT abit_entrant.id as "abit_entrant.id"
        , abit_abiturients.id as "abit_abiturients.id"
        , abit_abiturients.lastname
        , abit_abiturients.firstname
        , abit_abiturients.patronymic
        , IF(abit_abiturients.sex_id=1,"м", IF(abit_abiturients.sex_id=2, "ж", "?")) as gender

        /*
        , abit_faculties.faculty_name "Факультет"
        , CONCAT(abit_abitspeciality.specialityNumber, " ", abit_abitspeciality.name) "Направление подготовки"
        , abit_eduprofile.name "Профиль"
        , abit_eedufinancing.name "Финансирование"
        , abit_eeduform.name "Форма обучения"
        , abit_eduduration.name "Срок обучения"
        */

        , abit_abiteducompgroup.id as cgid
        -- , abit_abitspeciality.name

        , CONCAT_WS(", "
           , CONCAT(abit_abitspeciality.specialityNumber, " ", abit_abitspeciality.name)
        --   , abit_faculties.faculty_name
        --   , abit_eduprofile.name
           , abit_edugrade.name
           , abit_eedufinancing.name
           , abit_eeduform.name
        --   , abit_eduduration.name
           ) as cgname

        , abit_abiturients.has_diploma_original
        , (select count(*) from abit_entrant e
            join abit_abiteducompgroup cg on cg.id = e.ref_abit_abiteducompgroup
            join abit_eabitstate est on est.id = e.ref_abit_eabitstate
           where 1
             and cg.receptionYear = 2014
             and cg.ref_abit_edugrade in (164,165)
             and cg.ref_abit_eedufinancing in (1)
             and cg.ref_abit_eeduform in (1)
             and cg.id in (7104, 7155, 7172, 7246, 7169, 7244, 7242)

             and e.ref_abit_abiturients = abit_abiturients.id
             and e.inputdate <= abit_entrant.inputdate

           order by e.inputdate
           ) as priority
        , abit_entrant.scoresum
        , (select count(*) from abit_entrant e
            join abit_abiteducompgroup cg on cg.id = e.ref_abit_abiteducompgroup
            join abit_eabitstate est on est.id = e.ref_abit_eabitstate
           where 1
             and cg.receptionYear = 2014
             and cg.ref_abit_edugrade in (164,165)
             and cg.ref_abit_eedufinancing in (1)
             and cg.ref_abit_eeduform in (1)
             and cg.id in (7104, 7155, 7172, 7246, 7169, 7244, 7242)

             and e.ref_abit_abiturients = abit_abiturients.id

           ) as app_count

        , abit_entrant.outofcompetition
        , abit_entrant.is_noexam
        , abit_entrant.ref_abit_target_regions

        , abit_abiteducompgroup.Plan
        , abit_abiteducompgroup.PlanQuota
        , abit_abiteducompgroup.PlanRegion
        , abit_faculties.code
        , abit_abiteducompgroup.ref_abit_eeduform
        , abit_abiteducompgroup.ref_abit_eedufinancing
        , abit_abiteducompgroup.ref_abit_edugrade

        , IF(abit_abiturients.has_achievements_honor, 3, 0) as has_achievements_honor
        , IF(abit_abiturients.has_achievements_sport, 2, 0) as has_achievements_sport
        , IF(abit_abiturients.has_achievements_contest, 5, 0) as has_achievements_contest

        from abit_entrant
        join abit_abiteducompgroup on abit_abiteducompgroup.id = abit_entrant.ref_abit_abiteducompgroup
        join abit_abitspeciality on abit_abitspeciality.id = abit_abiteducompgroup.ref_abit_abitspeciality
        join abit_abiturients on abit_abiturients.id = abit_entrant.ref_abit_abiturients
        join abit_eabitstate on abit_eabitstate.id = abit_entrant.ref_abit_eabitstate

        left join abit_faculties on abit_faculties.id = abit_abiteducompgroup.ref_abit_faculties
        left join abit_edugrade on abit_edugrade.id = abit_abiteducompgroup.ref_abit_edugrade
        left join abit_eeduform on abit_eeduform.id = abit_abiteducompgroup.ref_abit_eeduform
        left join abit_eedufinancing on abit_eedufinancing.id = abit_abiteducompgroup.ref_abit_eedufinancing
        left join abit_eduduration on abit_eduduration.id = abit_abiteducompgroup.ref_abit_eduduration
        left join abit_eduprofile on abit_eduprofile.id = abit_abiteducompgroup.ref_abit_eduprofile

        where 1
          and abit_abiteducompgroup.receptionYear = 2014
          and abit_abiteducompgroup.ref_abit_edugrade in (164,165)
          and abit_abiteducompgroup.ref_abit_eedufinancing in (1)
          and abit_abiteducompgroup.ref_abit_eeduform in (1)
          and abit_abiteducompgroup.id in (7104, 7155, 7172, 7246, 7169, 7244, 7242)


        having 1
        --  and app_count > 2

        order by abit_abiturients.id, abit_entrant.scoresum

        -- limit 200
        ';
        // var_dump($query);die;

        $sql = \Reflexion\MySQL::getInstance($kernel);
        $q = $sql->query($query);
        $fp = fopen('/var/wwworm/herzen-admission-orm/config/applications.csv', 'w');
        $fst = true;
        while ($r = $sql->fetch_array($q)) {
            if ($fst) {
                fputcsv($fp, $r, "\t");
                $fst = false;
            }
            fputcsv($fp, $r, "\t");
        }
    }
    dump();
    if (!empty($_POST["return"])) {
        header("Location: " . $_POST["return"]);
    }
}

$views = array("compgroup", "entrant", "competitivelist", "enroll");

define("DEFAULT_LIMIT", 200);

$options = array();
$options["view"] = isset($_GET["view"]) && in_array($_GET["view"], $views) ? $_GET["view"] : array_shift(array_values($views));
$options["show_content"] = isset($_GET["show_content"]) && $_GET["show_content"];
$options["filter_compgroup"] = isset($_GET["filter_compgroup"]) ? $_GET["filter_compgroup"] : null;
$options["filter_application"] = isset($_GET["filter_application"]) ? $_GET["filter_application"] : null;
$options["filter_entrant"] = isset($_GET["filter_entrant"]) ? $_GET["filter_entrant"] : null;
$options["stage"] = isset($_GET["stage"]) ? $_GET["stage"] : null;
$options["from"] = isset($_GET["from"]) ? $_GET["from"] : null;
$options["limit"] = isset($_GET["limit"]) ? $_GET["limit"] : DEFAULT_LIMIT;
$options["hide_not_enrolllable"] = isset($_GET["hide_not_enrolllable"]) ? $_GET["hide_not_enrolllable"] : false;


$exclude_options = array("filter_compgroup", "filter_application", "filter_entrant");

$html_body = [];

$campaign = new Orm\CampaignRealMock();

$applicationRealMockGenerator = new Orm\ApplicationRealMockGenerator();

$applications = $applicationRealMockGenerator->getApplications($campaign);

$entrants = Orm\EntrantMock::getEntrants();


if ($options["view"] == "entrant") {
    $eCount = 0;
    foreach ($entrants as $entrant) {
        $eCount++;
        $appCount = 0;
        if ($options["show_content"]) {
            foreach ($entrant->getApplications() as $application) {
                $appCount++;
                $html_body[] = array(
                    "№" => $eCount . '.' . $appCount,
                    "№ з." => $application->getNumber(),
                    "№ аб." => $entrant->getId(),
                    "ФИО" => $entrant->getFIO(),
                    "Пол" => $entrant->getGender(),
                    "Сумма" => $application->getPointsTotal(),
                    "Оригинал" => $application->isEnrollable() ? "оригинал" : "",
                    "Приоритет" => $application->getPriority(),
                );
            }
        } else {
            $html_body[] = array(
                "№" => $eCount,
                "№ аб." => $entrant->getId(),
                "ФИО" => $entrant->getFIO(),
                "Пол" => $entrant->getGender(),
            );
        }
    }
}

if ($options["view"] == "compgroup") {
    $cgCount = 0;
    foreach ($campaign->getCompetitiveGroups() as $cg) {
        $cgCount++;
        $appCount = 0;
        if ($options["show_content"]) {
            foreach ($cg->getApplications() as $application) {
                $appCount++;
                $html_body[] = array(
                    "№" => $cgCount . '.' . $appCount,
                    "№ з." => $application->getNumber(),
                    "ФИО" => $application->getEntrant()->getFIO(),
                    "Пол" => $application->getEntrant()->getGender(),
                    "№ КГ." => $cg->getId(),
                    "КГ" => $cg->getName(),
                    "Сумма" => $application->getPointsTotal(),
                    "Оригинал" => $application->isEnrollable() ? "оригинал" : "",
                    "Приоритет" => $application->getPriority(),
                    "Приоритет > class" => "priority priority-" . $application->getPriority(),
                );
            }
        } else {
            $html_body[] = array(
                "№" => $cgCount,
                "№ КГ." => $cg->getId(),
                "КГ" => $cg->getName(),
            );
        }
    }
}

if (in_array($options["view"], array("competitivelist", "enroll"))) {
    $competitiveList = Orm\CompetitiveList::createFromCampaign($campaign);

    if ($options["view"] == "enroll") {
        $enrollmentList = new Orm\EnrollmentList($competitiveList);
        $priorityEnrollment = new Orm\Enrollment\PriorityEnrollment($enrollmentList);

        // $benefitStage = new Orm\BenefitEnrollmentStage();
        $noExamStage = new Orm\NoExamEnrollmentStage();
        $quotaStage = new Orm\QuotaEnrollmentStage();
        $targetStage = new Orm\TargetEnrollmentStage();

        $firstStage = new Orm\FirstEnrollmentStage();
        $secondStage = new Orm\SecondEnrollmentStage();

        if ($options["stage"] == "benefit-quota") {
            $priorityEnrollment->enroll($quotaStage);
        } elseif ($options["stage"] == "benefit-target") {
            $priorityEnrollment->enroll($quotaStage);
            $priorityEnrollment->enroll($targetStage);
        } elseif ($options["stage"] == "benefit-noexam") {
            $priorityEnrollment->enroll($quotaStage);
            $priorityEnrollment->enroll($targetStage);
            $priorityEnrollment->enroll($noExamStage);
        } elseif ($options["stage"] == "benefit") {
            $priorityEnrollment->enroll($quotaStage);
            $priorityEnrollment->enroll($targetStage);
            $priorityEnrollment->enroll($noExamStage);
        } elseif ($options["stage"] == "common-1") {
            $priorityEnrollment->enroll($quotaStage);
            $priorityEnrollment->enroll($targetStage);
            $priorityEnrollment->enroll($noExamStage);
            $priorityEnrollment->enroll($firstStage);
        } elseif ($options["stage"] == "common-2") {
            $priorityEnrollment->enroll($quotaStage);
            $priorityEnrollment->enroll($targetStage);
            $priorityEnrollment->enroll($noExamStage);
            $priorityEnrollment->enroll($firstStage);
            $priorityEnrollment->enroll($secondStage);
        }
    }

    $applications = $competitiveList->getApplications();


    $appCountTotal = count($applications);
    $appCount = 0;
    $displayAppCount = 0;
    $enrolledAppCount = array();

    if ($options["limit"] == 0) {
        $options["limit"] = $appCountTotal;
    }
    foreach ($applications as $application) {
        $competitiveGroup = $application->getCompetitiveGroup();
        $cg = $competitiveGroup->getId();

        if (empty($enrolledAppCount[$cg])) {
            $enrolledAppCount[$cg] = 0;
        }
        if ($application->isEnrolled()) {
            $enrolledAppCount[$cg]++;
        }

        $appCount++;
        if ($options["from"]) {
            if ($appCount < $options["from"]) {
                continue;
            }
        }

        $displayAppCount++;
        if ($displayAppCount > $options["limit"]) {
            break;
        }


        if ($options["filter_compgroup"]) {
            if ($options["filter_compgroup"] != $cg) {
                continue;
            }
        }
        if ($options["hide_not_enrolllable"]) {
            if (!$application->isEnrollable()) {
                continue;
            }
        }
        if ($options["filter_entrant"]) {
            if ($options["filter_entrant"] != $application->getEntrant()->getId()) {
                continue;
            }
        }
        if ($options["filter_application"]) {
            if ($options["filter_application"] != $application->getNumber()) {
                continue;
            }
        }

        $style = array(
            "color" => $competitiveGroup->getColor(),
            "font-weight" => "bold",
            "text-align" => "center",
        );

        $competitiveGroupList = Orm\CompetitiveList::createFromCompetitiveGroup($competitiveGroup);
        $position = $competitiveGroupList->getApplicationPosition($application);
        $total = $competitiveGroupList->getApplicationCount();

        $plan = $competitiveGroup->getPlan();
        $planQuota = $competitiveGroup->getPlanQuota();
        $planTarget = $competitiveGroup->getPlanTarget();

        if ($options["view"] == "enroll") {
            // if ($application->isEnrollable()) {
            //     if ($noExamStage->allowsEnrollment($application)) {
            //         $noExamStage->addApplication($application);
            //     } elseif ($quotaStage->allowsEnrollment($application)) {
            //         $quotaStage->addApplication($application);
            //     } elseif ($targetStage->allowsEnrollment($application)) {
            //         $targetStage->addApplication($application);
            //     } else {
            //         // $enrolledCommon++;
            //     }
            // }
        }

        $row = array(
            "> class" => implode(" ", array(
                    "entrant-id-" . $application->getEntrant()->getId(),
                    "application-id-" . $application->getNumber(),
                    ($options["view"] == "enroll" && !empty($options["stage"])
                        ? ($application->isEnrolled()
                            ? ('enroll-success stage-highlight-' . ($application->getEnrollmentStage()->getAlias() == $options["stage"]))
                            : 'enroll-fail')
                        : ''),
                )),
            "> attr" => array("competition" => ($application->getIsNoexams()
                            ? 'noexam'
                        : ($application->getIsQuota()
                            ? 'quota'
                        : ($application->getIsTarget()
                            ? 'target'
                        : 'common')))),

            "!" => ''
                . linkify(["limit" => DEFAULT_LIMIT, "from" => $appCount], $exclude_options, ''
                    . $appCount
                    . ' из '
                    . $appCountTotal
                    . '')
                . '<br/>'
                . '&nbsp;&nbsp;&nbsp;&#9632;&nbsp;&nbsp;&nbsp;'
                . '<br/>'
                . $displayAppCount
                . ' из '
                . $options["limit"]
                . '',
            "! > class" => 'checkbox',
            "! > style" => $style,


            "№ КГ." => ''
                . $cg
                . '<br/>'
                . linkify(['filter_compgroup' => $cg, "limit" => DEFAULT_LIMIT], $exclude_options, $cg)
                . '',
            "№ КГ. > style" => $style,

            "Position" => $position,
            "Position > style" => array(
                "text-align" => "center",
            ),

            "CPosition" => $application->getCompetitiveListPosition(),
            "CPosition > style" => array(
                "text-align" => "center",
                "font-weight" => $options["view"] == "competitivelist" ? "bold" : "",
            ),

            "Total" => $total,

            "EPosition" => $application->getEnrollmentListPosition(),
            "EPosition > style" => array(
                "text-align" => "center",
                "font-weight" => $options["view"] == "enroll" ? "bold" : ""
            ),

            "План" => $plan,
            "План ОК" => $planQuota,
            "План Ц" => $planTarget,

            "№ з." => ''
                . $application->getNumber()
                . '<br/>'
                . linkify(['filter_application' => $application->getNumber(), "limit" => "0"], $exclude_options, $application->getNumber())
                . '',
            "№ з. > attr" => array("application-id" => $application->getNumber()),
            "№ з. > class" => "application-id",

            "Конкурс" => ($application->getIsNoexams()
                            ? 'БЭ'
                        : ($application->getIsQuota()
                            ? 'ОК'
                        : ($application->getIsTarget()
                            ? 'Ц'
                        : ''))),
            "Конкурс > class" => implode(" ", array(
                                "benefit-noexam-" . $application->getIsNoexams(),
                                "benefit-quota-" . $application->getIsQuota(),
                                "benefit-target-" . $application->getIsTarget(),
                            )),
            "БЭ" => $application->getIsNoexams() ? 'БЭ' : '',
            "БЭ > class" => "noexam benefit-noexam-" . $application->getIsNoexams(),
            "ОК" => $application->getIsQuota() ? 'ОК' : '',
            "ОК > class" => "quota benefit-quota-" . $application->getIsQuota(),
            "Ц" => $application->getIsTarget() ? 'Ц' : '',
            "Ц > class" => "target benefit-target-" . $application->getIsTarget(),

            "№ аб." => ''
                . $application->getEntrant()->getId()
                . '<br/>'
                . linkify(['filter_entrant' => $application->getEntrant()->getId(), "limit" => "0"], $exclude_options, $application->getEntrant()->getId())
                . '',
            "№ аб. > attr" => array("entrant-id" => $application->getEntrant()->getId()),
            "№ аб. > class" => "entrant-id",
            "ФИО" => $application->getEntrant()->getFIO(),
            "Пол" => $application->getEntrant()->getGender(),
            "КГ" => $competitiveGroup->getName(),
            "Оригинал" => $application->isEnrollable() ? "оригинал" : "",
            "Сумма" => $application->getPointsTotal(),
            "Приоритет" => $application->getPriority(),
            "Приоритет > class" => "priority priority-" . $application->getPriority(),
        );

        if ($options["view"] == "enroll") {
            $enrollApp = $application->getEntrant()->getEnrollApplication();

            $row += array(
                "Зачислено" => ''
                    . $enrolledAppCount[$cg]
                    . '<br/>'
                    . ($application->isEnrolled()
                    ? (''
                        . count($application->getCompetitiveGroup()->getEnrolledApplications($application->getEnrollmentStage()))
                        . '/'
                        . count($application->getCompetitiveGroup()->getEnrolledApplications())
                        . '<br/>'
                        . "зачислен, " . $application->getEnrollmentStage()->getName()
                        . '')
                    : ($enrollApp
                        ? (''
                            . 'зачислен по другому заявлению<br/>'
                            . linkify(['filter_application' => $enrollApp->getNumber(), "limit" => "0"], $exclude_options, $enrollApp->getNumber())
                            . '')
                        : '')
                    ),
                "Зачислено > class" => $application->isEnrolled() ? ($application->getEnrollmentStage()->getAlias() . '-1') : '',

                "Прим." => $application->getComment(),

                "Зачисление" => ''
                    . 'План: '
                    . '<span class="plan-total plan-' . $cg . '">' . $plan . '</span>'
                    . '/'
                    . '<span class="plan-quota plan-' . $cg . '-quota benefit-quota-1">' . $planQuota . '</span>'
                    . '/'
                    . '<span class="plan-target plan-' . $cg . '-target benefit-target-1">' . $planTarget . '</span>'
                    . '<br/>'
                    . 'Зачислено: '
                    . '<span class="enrolled-noexam enrolled-' . $cg . '-noexam benefit-noexam-1">' . count($application->getCompetitiveGroup()->getEnrolledApplications($noExamStage)) . '</span>'
                    . '+'
                    . '<span class="enrolled-quota enrolled-' . $cg . '-quota benefit-quota-1">' . count($application->getCompetitiveGroup()->getEnrolledApplications($quotaStage)) . '</span>'
                    . '+'
                    . '<span class="enrolled-target enrolled-' . $cg . '-target benefit-target-1">' . count($application->getCompetitiveGroup()->getEnrolledApplications($targetStage)) . '</span>'
                    . '+'
                    . '<span class="enrolled-common enrolled-' . $cg . '-common-1">' . count($application->getCompetitiveGroup()->getEnrolledApplications($firstStage)) . '</span>'
                    . '+'
                    . '<span class="enrolled-common enrolled-' . $cg . '-common-2">' . count($application->getCompetitiveGroup()->getEnrolledApplications($secondStage)) . '</span>'
                    . '='
                    . '<span class="enrolled-common enrolled-' . $cg . '-total">' . count($application->getCompetitiveGroup()->getEnrolledApplications()) . '</span>'
                    . '<br/>'
                    . 'Свободно: '
                    . '<span class="free-total free-' . $cg . '-total">' . ($plan - count($application->getCompetitiveGroup()->getEnrolledApplications()))  . '</span>'
                    . '/'
                    . '<span class="free-quota free-' . $cg . '-quota benefit-quota-1">' . ($planQuota - count($application->getCompetitiveGroup()->getEnrolledApplications($quotaStage))) . '</span>'
                    . '/'
                    . '<span class="free-target free-' . $cg . '-target benefit-target-1">' . ($planTarget - count($application->getCompetitiveGroup()->getEnrolledApplications($targetStage))) . '</span>'
                    . '',
            );
        }

        $html_body[] = $row;
    }
}

$from = array();
$from["1"] = "Начало";
if (($prev_page = $options["from"] - $options["limit"]) > 0) {
    if (!isset($from[$prev_page])) {
        $from[$prev_page] = "←" . $options["limit"];
    }
}
if (($prev_one = $options["from"] - 1) > 0) {
    if (!isset($from[$prev_one])) {
        $from[$prev_one] = "←" . "1";
    }
}
if (!isset($from[$options["from"]])) {
    $from[$options["from"]] = "Текущая страница";
}
if (($next_one = $options["from"] + 1) <= $appCountTotal) {
    if (!isset($from[$next_one])) {
        $from[$next_one] = "→" . "1";
    }
}
if (($next_page = $options["from"] + $options["limit"]) <= $appCountTotal) {
    if (!isset($from[$next_page])) {
        $from[$next_page] = "→" . $options["limit"];
    }
}

$args = array(
    'view' => array(
        'values' => array_combine($views, $views),
        'label' => 'Режим просмотра',
    ),
    'show_content' => array(
        'values' => array(1 => "да", 0 => "нет"),
        'label' => 'Отображать детали',
    ),
    'cg' => array(
        "values" => $campaign->getCompetitiveGroups(),
        "label" => "КГ",
        "empty" => true,
    ),
    'stage' => array(
        "values" => array(
            "benefit" => "Льготный",
            "benefit-quota" => "Льготный (ОК)",
            "benefit-target" => "Льготный (Ц)",
            "benefit-noexam" => "Льготный (БЭ)",
            "common-1" => "Первый",
            "common-2" => "Второй",
        ),
        "label" => "Этап зачисления",
        "empty" => true,
    ),
    'from' => array(
        "values" => $from,
        "label" => "Прокрутка",
        "empty" => true,
    ),
    'limit' => array(
        "values" => array(
            "100" => "100",
            "200" => "200",
            "0" => "Все",
        ),
        "label" => "Прокрутка",
        "empty" => true,
    ),
    'hide_not_enrolllable' => array(
        'values' => array(1 => "да", 0 => "нет"),
        "label" => "Скрыть без оригиналов",
    ),
);

?>
<!doctype html>
<html>
<head>
    <title>Зачисление</title>
    <meta charset="utf-8">
    <style>
        table {
            border-collapse: collapse;
        }

        thead tr {
            color: #000 !important;
            background: #dadada !important;
            font-weight: bold !important;
        }
        thead td {
            color: #000 !important;
            background: #dadada !important;
            font-weight: bold !important;
        }
        tr {

        }
        tr:hover {
            background: rgba(163, 163, 163, .5);
        }

        tr.active {
            background: rgba(250, 252, 163, 1);
        }
        tr.active:hover {
            background: rgba(209, 210, 163, 1);
        }

        td {
            border: 1px solid #adadad;
            padding: 3px;
        }
        td:hover {
            background: rgba(163, 163, 163, .6);
        }

        td.active {
        }
        td.active:hover {
        }

        .hidden {
            display: none;
        }
        .checkbox {
            border-left-width: 5px;
        }
        tr.active .checkbox {
            background: rgb(255,212,30);
        }
        li {
            list-style: none;
        }

        a:focus, .row-focused {
            background: #ffffaa;
        }

        .fis-wrapper {
            padding: 2px 0;
        }
        .fis-success {
            background: lightgreen;
            padding: 2px 5px;
        }
        .fis-warning:not(:empty) {
            background: orange;
            padding: 2px 5px;
        }
        .fis-fail {
            background: salmon;
            padding: 2px 5px;
        }
        .fis-notify {
            background: lightblue;
            padding: 2px 5px;
        }
        .fis-none {
            background: yellow;
        }
        .fis-skip {
            color: #adadad;
        }

        .monospaced-wrapper {
            padding: 2px 0px;
        }
        .monospaced {
            background: #efefef;
            padding: 2px 5px;
        }

        .hr {
            border: none;
            border-bottom: 1px dotted white;
            margin: 0;
        }

        .priority {
            background-color: none;
            text-align: center;
        }
        .priority-1 {
            background-color: rgba(102, 178, 102, 0.69);
        }
        .priority-2 {
            background-color: rgba(170, 178, 102, 0.69);
        }
        .priority-3 {
            background-color: rgba(178, 151, 102, 0.69);
        }
        .priority-4 {
            background-color: rgba(178, 108, 102, 0.69);
        }
        .priority-5 {
            background-color: rgba(178, 102, 154, 0.69);
        }
        .priority-6 {
            background-color: rgba(102, 112, 178, 0.69);
        }

        .enroll-success .checkbox {
            border-left-color: green;
        }
        .enroll-fail {
            opacity: .3;
        }
        .enroll-fail:hover {
            opacity: .7;
        }

        .noexam {
            text-align: center;
        }
        .benefit-noexam-1 {
            font-weight: bold;
            color: #cf22f0;
        }
        .quota {
            text-align: center;
        }
        .benefit-quota-1 {
            font-weight: bold;
            color: #1dc7f9;
        }
        .target {
            text-align: center;
        }
        .benefit-target-1 {
            font-weight: bold;
            color: #fb9e11;
        }

        .stage-highlight-1 {
            font-weight: bold;
        }
    </style>
    <script type="text/javascript" src="/reflexion/js/jquery-latest.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("td a")
            .focus(function(){
                $(this).closest("tr")
                .addClass("row-focused")
            })
            .blur(function(){
                $(this).closest("tr")
                .removeClass("row-focused")
            })
        })
    </script>
    <script type="text/javascript">
        function calculateHighlights() {
            $("#application-chosen-count")
            .text($("tr.active").length);

            $("#application-chosen-list")
            .text($("tr.active").map(function(i,e) {
                return $(e).find(".application-id").attr("application-id");
            }).toArray().join(","));


            $entrants = $.unique($("tr.active").map(function(i,e) {
                return $(e).find(".entrant-id").attr("entrant-id");
            }).toArray())

            $("#entrant-chosen-count")
            .text($entrants.length)

            $("#entrant-chosen-list")
            .attr("jq", $entrants.map(function(e,i){
                return '.entrant-id-' + e;
            }).join(","))
            .text($entrants.join(","))
        }
        $(function(){

            $("td.checkbox").click(function(){
                var closest_tr = $(this).closest("tr");
                if ($("#highlight").is(":checked")) {
                    closest_tr.toggleClass("active");

                    calculateHighlights();

                }
                if ($("#highlight-enroll").is(":checked")) {
                    cg = $(this).siblings(".compgroup-id").text();
                    plan = $(this).siblings(".plan").attr("value");
                    planQuota = $(this).siblings(".plan-quota").attr("value");
                    planTarget = $(this).siblings(".plan-target").attr("value");

                    competition = closest_tr.attr("competition");

                    $enrolled = $(".enrolled-" + cg + "-" + competition);
                    $free = $(".free-" + cg + "-" + competition);

                    if (closest_tr.is(".active")) {
                        $enrolled.text($enrolled.text()*1+1)
                        $free.text($free.text()*1-1)
                    } else {
                        $enrolled.text($enrolled.text()*1-1)
                        $free.text($free.text()*1+1)
                    }


                }
            });

            $("#hide-highlighted").change(function(){
                $("tr:not(.active)").toggleClass("hidden")
            })

            $("#select-by-entrant").click(function(){
                $($("#entrant-chosen-list").attr("jq"))
                .closest("tr")
                .addClass("active")

                calculateHighlights()
            })
        })
    </script>
</head>
<body>

<div>
    <form method="POST" action="?">
        <input type="hidden" name="return" value="<?=$_SERVER["REQUEST_URI"];?>"  />
        <input type="submit" name="dump" value="Обновить список заявлений"  />
    </form>
</div>
<div>
    <label><input type="checkbox" id="highlight" /> Подсветка
    |
    <label><input type="checkbox" id="hide-highlighted" checked="checked" /> Переключить подсвеченные
    |
    <label><input type="checkbox" id="highlight-enroll" checked="checked" /> Подсветка=зачисление
</div>
<div>
    <span id="application-chosen-count"></span>
    =
    <span id="application-chosen-list"></span>
</div>
<div>
    <span id="entrant-chosen-count"></span>
    =
    <span id="entrant-chosen-list"></span>
    <input type="button" id="select-by-entrant" value="Выбрать все по этим номерам" />
</div>

<?=navigify($args);?>

<?=table($html_body);?>

</body>
</html>

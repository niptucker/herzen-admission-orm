<?php

namespace Herzen\Admission\Orm;

use Herzen\Utils\RandomUtils;

class ApplicationMockGenerator {

    public function generateOne($entrant, $competitiveGroups, $priority = null) {

        $competitiveGroup = RandomUtils::getRandomValueFromArray($competitiveGroups);

        if (!$entrant->hasApplication($competitiveGroup)) {
            return new ApplicationMock($entrant, $competitiveGroup, $priority);
        }

        return null;
    }

    public function generate($entrant, $competitiveGroups, $count, $withPriority = false) {
        $set = array();
        $max_priority = $count;
        while ($count-- > 0) {
            $priority = $max_priority - $count;
            $app = $this->generateOne($entrant, $competitiveGroups, $withPriority ? null : $priority);
            if ($app) {
                $set[] = $app;
            }
        }
        return $set;
    }

    public function generateRandomCount($entrant, $competitiveGroups, $withPriority = false) {
        $appCount = RandomUtils::getRandomKeyFromArray(array_keys($competitiveGroups));

        return $this->generate($entrant, $competitiveGroups, $appCount);
    }

}

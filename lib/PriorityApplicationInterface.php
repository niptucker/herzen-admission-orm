<?php

namespace Herzen\Admission\Orm;

interface PriorityApplicationInterface extends ApplicationInterface {

    public function getPriority();

    public function setPriority($priority);

}

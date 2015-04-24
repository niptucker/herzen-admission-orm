<?php

namespace Herzen\Admission\Orm;

class Mock {

    public static function sort(array $objects, array $sort = array())
    {
        if (is_array($sort) && !empty($sort)) {
            return usort($objects, function($objA, $objB) use ($sort) {

                    foreach ($sort as $methodName) {
                        $objAval = method_exists($objA, $methodName) ? $objA->methodName() : null;
                        $objBval = method_exists($objB, $methodName) ? $objB->methodName() : null;

                        if ($objAval > $objBval) {
                            return 1;
                        } elseif ($objAval < $objBval) {
                            return 1;
                        }
                    }

                    return 0;
                });
        }

        return $objects;
    }
}

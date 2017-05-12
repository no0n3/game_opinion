<?php

namespace app\components;

use yii\helpers\StringHelper;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class CStringHelper extends StringHelper {

    public static function splitStripWords($str, $n) {
        $words = explode(' ', $str);
        $i = 0;

        $result = '';

        foreach ($words as $word) {
            if (strlen($result) + $i > $n) {
                break;
            }

            $result .= $word . ' ';
            $i = strlen($result);
        }

        return $result;
    }

}

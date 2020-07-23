<?php

namespace Abtechi\Util;

/**
 * Aplica um formato de máscara
 * Class Mask
 * @package Util\Util
 */
class Mask
{
    /**
     * Aplica uma máscara de qualquer formato
     * MarskFormat(##.##.####)
     * @param $mask
     * @param $value
     * @return string
     */
    public static function format($mask, $value)
    {
        $maskared = '';
        $k = 0;
        for($i = 0; $i <= strlen($mask)-1; $i++)
        {
            if($mask[$i] == '#')
            {
                if(isset($value[$k]))
                    $maskared .= $value[$k++];
            }
            else
            {
                if(isset($mask[$i]))
                    $maskared .= $mask[$i];
            }
        }

        return $maskared;
    }
}
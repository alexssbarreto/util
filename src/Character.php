<?php

namespace Abtechi\Util\Util;

/**
 * Class Character
 * @package Util\Util
 */
class Character
{
    /**
     * Remove caracteres especiais
     * @param $string
     * @return mixed
     */
    public static function sanitize($string)
    {
        return preg_replace('{\W}', '', preg_replace('{ +}', '_', strtr(
            utf8_decode(html_entity_decode($string)),
            utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'),
            'AAAAEEIOOOUUCNaaaaeeiooouucn')));
    }

    /**
     * Substitui caracteres especiais
     * @param $string
     * @param string $replacement
     * @return mixed
     */
    public static function replaceSpecial($string, $replacement = '')
    {
        return preg_replace('{\W}', $replacement, strtr(
            utf8_decode(html_entity_decode($string)),
            utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'),
            'AAAAEEIOOOUUCNaaaaeeiooouucn'));
    }
}
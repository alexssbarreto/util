<?php

namespace Abtechi\Util;

/**
 * Class CNPJ
 * @package Abtechi\Util
 */
class CNPJ
{

    /**
     * Checa se CNPJ é válido
     * @param $cnpj
     * @return bool
     */
    public static function valido($cnpj)
    {
        $cnpj = self::trata($cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    /**
     * Remove caracteres especiais do CNPJ
     * @param $cnpj
     * @return mixed
     */
    public static function trata($cnpj)
    {
        return preg_replace('/[^0-9]/', '', (string) $cnpj);
    }

    /**
     * Formata um CNPJ
     * @param $cnpj
     * @return string
     */
    public static function formata($cnpj)
    {
        return Mask::format('##.###.###/####-##', $cnpj);
    }
}
<?php

namespace Abtechi\Util;

/**
 * Conversão de valores
 * Class Money
 * @package Util\Util
 */
class Money
{

    const Real  = 'R$';
    const Dolar = 'US$';
    const Libra = '£';
    const Euro  = '€';

    /**
     * Remove caracteres especiais de uma moeda
     * @param $valor
     * @return mixed
     */
    public static function trataMoney($valor)
    {
        $valor = preg_replace("/[^0-9-,]+/", "", $valor);

        return str_ireplace(',', '.', str_ireplace('.', '', $valor));
    }

    /**
     * Converte um valor para money
     * @param $valor
     * @return mixed
     */
    public static function toMoney($valor)
    {
        return str_ireplace(',', '.', str_ireplace('.', ',', $valor));
    }

    /**
     * Formata um valor para money
     * @param $valor
     * @param int $decimal
     * @return string
     */
    public static function format($valor, $decimal = 2)
    {
        return number_format($valor, $decimal, ',', '.');
    }
}
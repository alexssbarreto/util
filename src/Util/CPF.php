<?php

namespace Abtechi\Util\Util;

/**
 * Class CPF
 * @package Util\Util
 */
class CPF
{

    /**
     * Checa se CPF é válido
     * @param null $cpf
     * @return bool
     */
    public static function valido($cpf)
    {
        // Elimina possivel mascara
        $cpf = preg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }

    /**
     * Remove caracteres especiais de um CPF
     * @param $cpf
     * @return string
     */
    public static function trata($cpf)
    {
        return str_pad(preg_replace('/[^0-9]/', '', (string)$cpf), 11, 0, STR_PAD_LEFT);
    }

    /**
     * Formata um CPF
     * @param $cpf
     * @return string
     */
    public static function formata($cpf)
    {
        return Mask::format('###.###.###-##', $cpf);
    }
}
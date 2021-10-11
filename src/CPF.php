<?php
namespace Abtechi\Util;

/**
 * Tratativa de CPF
 * @author barreto
 *
 */
class CPF
{

    /**
     * Checa se CPF é válido
     *
     * @param null $cpf
     * @return bool
     */
    public static function valido($cpf)
    {
        $cpf = CPF::trata($cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if ($cpf == '00000000000' || $cpf == '11111111111' ||
            $cpf == '22222222222' || $cpf == '33333333333' ||
            $cpf == '44444444444' || $cpf == '55555555555' ||
            $cpf == '66666666666' || $cpf == '77777777777' ||
            $cpf == '88888888888' || $cpf == '99999999999') {
            return false;
        }

        for ($t = 9; $t < 11; $t ++) {
            for ($d = 0, $c = 0; $c < $t; $c ++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    /**
     * Remove caracteres especiais de um CPF
     *
     * @param $cpf
     * @return string
     */
    public static function trata($cpf)
    {
        return str_pad(preg_replace('/[^0-9]/', '', (string) $cpf), 11, 0, STR_PAD_LEFT);
    }

    /**
     * Formata um CPF
     *
     * @param $cpf
     * @return string
     */
    public static function formata($cpf)
    {
        return Mask::format('###.###.###-##', $cpf);
    }
}
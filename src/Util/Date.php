<?php

namespace Abtechi\Util;

/**
 * Validação de Datas - Datetime
 * Class Date
 * @package Util\Util
 */
class Date
{

    const EQUAL = '=';
    const LEFT = '<';
    const LEFTEQUAL = '<=';
    const RIGHT = '>';
    const RIGHTEQUAL = '>=';

    protected static $date;

    /**
     * Valida se uma data é válida conforme determinado formato
     * @param $date
     * @param string $format
     * @return bool
     */
    public static function isValid($date, $format = 'Y-m-d H:i:s')
    {
        self::$date = \DateTime::createFromFormat($format, $date);
        return self::$date && self::$date->format($format) == $date;
    }

    /**
     * Cria uma data a partir do formato de entrada de dados
     * @param null $date
     * @param string $formatInput
     * @return \DateTime|false|string
     */
    public static function create($date = null, $formatInput = 'Y-m-d H:i:s')
    {
        $timezone = new \DateTimeZone('America/Sao_Paulo');

        if (!$date) {
            $date = date_create_from_format($formatInput, $date, $timezone);

        } else {
            if (strpos($date, '/') === false && strpos($date, '-') === false) {
                $date = date_create_from_format($formatInput, $date, $timezone);

            } else{
                $date = date_create_from_format($formatInput, $date, $timezone);
            }
        }

        if (!is_object($date)) {
            $dateTime = new \DateTime($date, $timezone);
            if ($formatInput) {
                $dateTime->format($formatInput);
            }
            self::$date = $dateTime;
        } else {
            self::$date = $date;
        }

        return self::$date;
    }

    /**
     * Cria um timestamp
     * @return int
     */
    public static function createTimestamp()
    {
        $date = new \DateTime(date('Y-m-d H:i:s'));

        return $date->getTimestamp();
    }

    /**
     * Formata uma determinada data
     * @param string $format
     * @param string $date
     * @return bool|string
     */
    public static function format($format = '%d de %B de %Y', $date = 'today')
    {
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $date = utf8_encode(strftime($format, strtotime($date)));

        return $date;
    }

    /**
     * Compara se uma data é menor que outra data
     * @param \DateTime $data
     * @param \DateTime $data2
     * @return bool
     */
    public static function menor(\DateTime $data, \DateTime $data2)
    {
        return self::compareDate($data, $data2, self::LEFT);
    }

    /**
     * Compara se uma data e menor ou igual outra data
     * @param \DateTime $data
     * @param \DateTime $data2
     * @return bool
     */
    public static function menorIgual(\DateTime $data, \DateTime $data2)
    {
        return self::compareDate($data, $data2, self::LEFTEQUAL);
    }

    /**
     * Compara se uma data é igual outra data
     * @param \DateTime $data
     * @param \DateTime $data2
     * @return bool
     */
    public static function igual(\DateTime $data, \DateTime $data2)
    {
        return self::compareDate($data, $data2, self::EQUAL);
    }

    /**
     * Compara se uma data é maior que outra data
     * @param \DateTime $data
     * @param \DateTime $data2
     * @return bool
     */
    public static function maior(\DateTime $data, \DateTime $data2)
    {
        return self::compareDate($data, $data2, self::RIGHT);
    }

    /**
     * Compra se uma data é maior ou igual outra data
     * @param \DateTime $data
     * @param \DateTime $data2
     * @return bool
     */
    public static function maiorIgual(\DateTime $data, \DateTime $data2)
    {
        return self::compareDate($data, $data2, self::RIGHTEQUAL);
    }

    /**
     * Compara uma determinada data.
     * @param $data
     * @param $data2
     * @param $comparable
     * @return bool
     */
    private static function compareDate($data, $data2, $comparable)
    {
        $data  = strtotime($data->format('Y-m-d H:i:s'));
        $data2 = strtotime($data2->format('Y-m-d H:i:s'));

        switch ($comparable) {
            case self::LEFT:
                return $data < $data2;

            case self::LEFTEQUAL:
                return $data <= $data2;

            case self::EQUAL:
                return $data == $data2;

            case self::RIGHT:
                return $data > $data2;

            case self::RIGHTEQUAL:
                return $data >= $data2;
        }
    }
}
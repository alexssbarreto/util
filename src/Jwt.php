<?php

namespace Abtechi\Util\Util;

/**
 * Classe responsável por gerar token JWT
 * Class Jwt
 * @package App\Service
 */
final class Jwt
{

    /**
     * @param array $header
     * @param array $payload
     * @param $secret
     * @return string
     */
    public static function generateJwt(array $header, array $payload, $secret)
    {
        // estrutura de dados
        $header = json_encode($header);
        $payload = json_encode($payload);

        $header = base64_encode($header);
        $payload = base64_encode($payload);

        // conversão de dados para urlEncode
        $header = str_replace(['+', '/', '='], ['-', '_', ''], $header);
        $payload = str_replace(['+', '/', '='], ['-', '_', ''], $payload);

        // gera assinatura
        $signature = hash_hmac('sha256', $header . "." . $payload, $secret, true);
        $signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $header . "." . $payload . "." . $signature;
    }

    /**
     * Gera Assinatura
     * @param $api_key
     * @param $api_sercet
     * @param $meeting_number
     * @param $role
     * @return string
     */
    public static function generateSignature($api_key, $api_sercet, $meeting_number, $role)
    {
        $time = time() * 1000; //time in milliseconds (or close enough)

        $data = base64_encode($api_key . $meeting_number . $time . $role);

        $hash = hash_hmac('sha256', $data, $api_sercet, true);

        $_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);

        //return signature, url safe base64 encoded
        return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
    }
}
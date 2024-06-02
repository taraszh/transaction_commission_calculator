<?php

namespace App\Component\Http;

use Exception;
use http\Client\Response;
use HttpException;

class HttpClient
{
    public function __construct(
        // Whatever http client you want to use
        private $client = null,
    ) {
    }

    /**
     * @return Response|string Disclaimer: this is just a dummy implementation not required for this exercise
     * @throws HttpException|Exception
     */
    public function get(string $url, array $options = []): Response|string
    {
        if ($this->client) {
         //   return $this->client->get($url, $options);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (isset($options['headers'])) {
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                $options['headers']
            );
        }

        $response = curl_exec($ch);

        if (!curl_errno($ch)) {
            switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:
                    break;
                default:
                    throw new Exception('Error fetching BIN data: ' . $http_code, 424);
            }
        }

        if ($response === false) {
            throw new Exception('Error fetching BIN data: ' . curl_error($ch), 424);
        }

        curl_close($ch);

        return $response;
    }
}
<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class ResponseService
{

    public function setHeaders(Response $response)
    {
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,PATCH');
        $response->headers->set('Access-Control-Allow-Headers', 'content-type');
        return $response;
    }

}
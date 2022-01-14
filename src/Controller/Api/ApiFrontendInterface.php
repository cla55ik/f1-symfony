<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;

interface ApiFrontendInterface
{
    public function getAll(): Response;
    public function getBy(): Response;
}
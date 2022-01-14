<?php

namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;

interface ApiCrudInterface
{
    public function getAll(): Response;
    public function getBy(): Response;
    public function create(): Response;
    public function update(): Response;
    public function delete(): Response;

}
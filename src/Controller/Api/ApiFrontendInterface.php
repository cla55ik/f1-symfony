<?php

namespace App\Controller\Api;

use App\Service\ResponseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

interface ApiFrontendInterface
{
    public function getAll(EntityManagerInterface $entityManager, ResponseService $responseService): Response;
    public function getBy(EntityManagerInterface $entityManager): Response;
}
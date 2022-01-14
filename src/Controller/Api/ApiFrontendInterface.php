<?php

namespace App\Controller\Api;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;

interface ApiFrontendInterface
{
    public function getAll(EntityManagerInterface $entityManager): Response;
    public function getBy(EntityManagerInterface $entityManager): Response;
}
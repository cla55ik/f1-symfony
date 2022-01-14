<?php

namespace App\Controller\Api;

use App\Entity\Pilot;
use App\Repository\PilotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;

#[Route('/api/pilot', name: 'api_pilot')]
class PilotApiController extends AbstractController implements ApiFrontendInterface
{
    #[Route('', name: '')]
    public function getAll(EntityManagerInterface $entityManager): JsonResponse
    {
        $pilots = $entityManager->getRepository(Pilot::class)->findAll();
        foreach ($pilots as $pilot){
            $arrayCollection[] = array(
                'id' => $pilot->getId(),
                'name' => $pilot->getName(),
                'surname' => $pilot->getSurname(),
                'comand' => [
                    'id' => $pilot->getComand()->getId(),
                    'name' => $pilot->getComand()->getName(),
                    'img' => $pilot->getComand()->getImg()
                ],
                'country' => [
                    'id' => $pilot->getCountry()->getId(),
                    'name' => $pilot->getCountry()->getName(),
                    'img' => $pilot->getCountry()->getImg()
                ],
                'img' => $pilot->getImg(),
                'number' => $pilot->getNumber()
            );
        }

        $data['items'] = $arrayCollection;
        return new JsonResponse($data);
    }

    #[Route('/{id}', name: '_id', requirements: ['id'=>'\d+'])]
    public function getBy(EntityManagerInterface $entityManager): Response
    {
        return $this->json("PilotGetBy");
    }
}
<?php

namespace App\Controller\Api;

use App\Entity\Comand;
use App\Entity\Country;
use App\Entity\Pilot;
use App\Repository\PilotRepository;
use App\Service\FileUploadService;
use App\Service\ResponseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;

#[Route('/api/pilot', name: 'api_pilot')]
class PilotApiController extends AbstractController implements ApiFrontendInterface
{
    public function __construct(
        private FileUploadService $fileUploadService
    )
    {

    }

    #[Route('', name: '')]
    public function getAll(EntityManagerInterface $entityManager, ResponseService $responseService): Response
    {
        $pilots = $entityManager->getRepository(Pilot::class)->findAll();
        foreach ($pilots as $pilot){
//            dd($this->fileUploadService->get64($pilot->getImg(), Pilot::IMG_UPLOAD_DIR));
            $arrayCollection[] = array(
                'id' => $pilot->getId(),
                'name' => $pilot->getName(),
                'surname' => $pilot->getSurname(),
                'comand' => [
                    'id' => $pilot->getComand()->getId(),
                    'name' => $pilot->getComand()->getName(),
                    'img' => $this->fileUploadService->get64($pilot->getComand()->getImg(), Comand::IMG_UPLOAD_DIR)
                ],
                'country' => [
                    'id' => $pilot->getCountry()->getId(),
                    'name' => $pilot->getCountry()->getName(),
                    'img' => $this->fileUploadService->get64($pilot->getCountry()->getImg(), Country::IMG_UPLOAD_DIR)
                ],
                'img' => $this->fileUploadService->get64($pilot->getImg(), Pilot::IMG_UPLOAD_DIR),
                'number' => $pilot->getNumber()
            );
        }

        $data['items'] = $arrayCollection;
        $response = new JsonResponse($data);
        $response = $responseService->setHeaders($response);
        return $response;
//        $response->headers->set()
    }

    #[Route('/{id}', name: '_id', requirements: ['id'=>'\d+'])]
    public function getBy(EntityManagerInterface $entityManager): Response
    {
        return $this->json("PilotGetBy");
    }
}
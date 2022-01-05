<?php

namespace App\Controller\Admin;

use App\Entity\Pilot;
use App\Form\PilotFormType;
use App\Repository\PilotRepository;
use App\Service\FileUploadService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('admin/pilot', name: 'admin_pilot')]
class PilotController extends AbstractController
{
    #[Route('', name: '')]
    public function index(PilotRepository $pilotRepository): Response
    {
        $pilots = $pilotRepository->findAll();
        return $this->render('admin/pilot/index.html.twig', [
            'pilots'=>$pilots
        ]);
    }

    #[Route('/{id}', name: '_get', requirements: ['id'=>'\d+'])]
    public function getPilot($id, PilotRepository $pilotRepository)
    {
        $pilot = $pilotRepository->find($id);
//        return $this->render()
    }

    #[Route('/create', name: '_create')]
    public function createPilot(PilotFormType $pilotFormType, FileUploadService $fileUploadService, Request $request, EntityManagerInterface $entityManager): Response
    {
        //TODO: проверка на Admin
        $pilot = new Pilot();
        $form = $this->createForm(PilotFormType::class, $pilot);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $pilot = $form->getData();
            $imgFile = $form->get('img')->getData();
            if ($imgFile){
                $pilot->setImg($fileUploadService->upload($imgFile, Pilot::IMG_UPLOAD_DIR));
            }
            $entityManager->persist($pilot);
            $entityManager->flush();
        }

        return $this->render('admin/pilot/create.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    #[Route('/update/{id}', name: '_update')]
    public function updatePilot($id, PilotRepository $pilotRepository, Request $request, FileUploadService $fileUploadService, EntityManagerInterface $entityManager): Response
    {
        $pilot = $pilotRepository->find($id);
        $form = $this->createForm(PilotFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $pilot->setName($data->getName());
            $pilot->setSurname($data->getSurname());
            $pilot->setComand($data->getComand());
            $pilot->setCountry($data->getCountry());

            $imgFile = $form->get('img')->getData();
            if ($imgFile){
                $pilot->setImg($fileUploadService->upload($imgFile, Pilot::IMG_UPLOAD_DIR));
            }

            $entityManager->persist($pilot);
            $entityManager->flush();
        }

        return $this->render('admin/pilot/update.html.twig', [
            'form'=>$form->createView()
        ]);

    }

    #[Route('/delete/{id}', name: '_delete')]
    public function deletePilot($id, PilotRepository $pilotRepository, EntityManagerInterface $entityManager): Response
    {
        $pilot = $pilotRepository->find($id);
        $entityManager->remove($pilot);
        $entityManager->flush();

        return $this->redirectToRoute('admin_pilot');
    }
}

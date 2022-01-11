<?php

namespace App\Controller\Admin;

use App\Entity\Race;
use App\Form\RaceFormType;
use App\Repository\RaceRepository;
use App\Service\FileUploadService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/race', name: 'admin_race')]
class RaceController extends AbstractController
{
    #[Route('', name: '')]
    public function index(RaceRepository $raceRepository): Response
    {
        $races = $raceRepository->findBy([], ['Date' => 'ASC']);
        return $this->render('admin/race/index.html.twig', [
            'races' => $races
        ]);
    }

    #[Route('/create', name: '_create')]
    public function createRace(Request $request, EntityManagerInterface $entityManager, FileUploadService $fileUploadService): Response
    {
        //TODO: проверка на Admin
        $race = new Race();
        $form = $this->createForm(RaceFormType::class, $race);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $race = $form->getData();
            if (empty($entityManager->getRepository(Race::class)->findBy(['Name'=>$form->getData()->getName()]))){
                $entityManager->persist($race);
                $entityManager->flush();
            }else{
                $this->addFlash('error','Duplicate name');
            }
        }

        return $this->render('admin/race/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/update/{id}', name: '_update')]
    public function updateRace($id, RaceRepository $raceRepository, Request $request, FileUploadService $fileUploadService, EntityManagerInterface $entityManager): Response
    {
        $race = $raceRepository->find($id);
        $form = $this->createForm(RaceFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $race->setName($data->getName());
            $race->setType($data->getType());
            $entityManager->persist($race);
            $entityManager->flush();
        }

        return $this->render('admin/race/update.html.twig', [
            'form'=>$form->createView(),
            'race'=>$race
        ]);

    }

    #[Route('/delete/{id}', name: '_delete', requirements: ['id' => '\d+'])]
    public function deleteRace($id, RaceRepository $raceRepository, EntityManagerInterface $entityManager): Response
    {
        $country = $raceRepository->find($id);
        $entityManager->remove($country);
        $entityManager->flush();

        return $this->redirectToRoute('admin_race');
    }
}

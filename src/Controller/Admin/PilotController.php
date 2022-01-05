<?php

namespace App\Controller\Admin;

use App\Entity\Pilot;
use App\Form\PilotFormType;
use App\Repository\PilotRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PilotController extends AbstractController
{
    #[Route('/admin/pilot', name: 'admin_pilot')]
    public function index(): Response
    {
        return $this->render('pilot/index.html.twig', [
            'controller_name' => 'PilotController',
        ]);
    }

    #[Route('/admin/pilot/{id}', name: 'admin_get_pilot', requirements: ['id'=>'\d+'])]
    public function getPilot($id, PilotRepository $pilotRepository)
    {
        $pilot = $pilotRepository->find($id);
//        return $this->render()
    }

    #[Route('admin/pilot/create', name: 'admin_pilot_create')]
    public function createPilot(PilotFormType $pilotFormType, Request $request, EntityManagerInterface $entityManager): Response
    {
        $pilot = new Pilot();
        $form = $this->createForm(PilotFormType::class, $pilot);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $pilot = $form->getData();
            $entityManager->persist($pilot);
            $entityManager->flush();
        }

        return $this->render('admin/pilot/create.html.twig');
    }
}

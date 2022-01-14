<?php

namespace App\Controller\Admin;

use App\Entity\Pilot;
use App\Entity\Racestat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/championship', name: 'admin_championship')]
class ChampionshipController extends AbstractController
{
    #[Route('/', name: '')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pilots = $entityManager->getRepository(Pilot::class)->findAll();
        $pilotPoint = [];
        foreach ($pilots as $pilot){
            $pilotPoint[] = ['name' => $pilot->getName() . ' ' .$pilot->getSurname(), 'point' => (int)$entityManager->getRepository(Racestat::class)->getPilotPoints($pilot->getId())[0][1] ?: 0];

        }
//        dd($pilotPoint);


        return $this->render('admin/championship/index.html.twig', [
            'pilotPoint' => $pilotPoint,
        ]);
    }
}

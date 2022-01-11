<?php

namespace App\Controller\Admin;

use App\Entity\Race;
use App\Entity\Racestat;
use App\EntityListener\RacestatEntityListener;
use App\Form\RaceStatFormType;
use App\Form\RaceStatAddType;
use App\Repository\RacestatRepository;
use App\Service\CalculatePointsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/racestat', name: 'admin_racestat')]
class RaceStatController extends AbstractController
{
    #[Route('', name: '')]
    public function index(RacestatRepository $racestatRepository): Response
    {
        $racestats = $racestatRepository->getStatsByWinner();
        return $this->render('admin/racestat/index.html.twig', [
            'racestats' => $racestats,
        ]);
    }

    #[Route('/create/{race_id}', name: '_create')]
    public function createRacestat(CalculatePointsService $calculatePointsService, $race_id, Request $request, EntityManagerInterface $entityManager): Response
    {
        //TODO: проверка на Admin
        $form = $this->createForm(RaceStatAddType::class);
        $race = $entityManager->getRepository(Race::class)->find($race_id);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            for($i=1; $i <= count($form->getData()); $i++){
                if (count(array_unique($form->getData()))  != count($form->getData() )){
                    $this->addFlash('error','Duplicate name create');
                    break;
                }

                if(!$entityManager->getRepository(Racestat::class)->findBy(['race' => $race_id, 'pilot' => $form->getData()[$i]->getId()])){
                    $racestat = new Racestat();
                    $racestat->setPilot($form->getData()[$i]);
                    $racestat->setPlace($i);
                    $racestat->setRace($race);
                    $racestat->setPoint($calculatePointsService->calculatePoints($racestat));
                    $entityManager->persist($racestat);
                    $entityManager->flush();
//                    dd($calculatePointsService->calculatePoints($racestat));

                }

            }
        }



        return $this->render('admin/racestat/create.html.twig', [
            'form' => $form->createView(),
            'race' => $race
        ]);

    }


    #[Route('/update/{race_id}', name: '_update')]
    public function updateRacestat(CalculatePointsService $calculatePointsService, RacestatEntityListener $racestatEntityListener, $race_id, Request $request, EntityManagerInterface $entityManager): Response
    {
        //TODO: проверка на Admin
        $form = $this->createForm(RaceStatAddType::class);
        $race = $entityManager->getRepository(Race::class)->find($race_id);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            for($i=1; $i <= count($form->getData()); $i++){
                if (count(array_unique($form->getData()))  != count($form->getData() )){
                    $this->addFlash('error','Duplicate name ');
                    break;
                }

                if(!$entityManager->getRepository(Racestat::class)->findBy(['race' => $race_id, 'pilot' => $form->getData()[$i]->getId()])){
                    $racestat = new Racestat();
                    $racestat->setPilot($form->getData()[$i]);
                    $racestat->setPlace($i);
                    $racestat->setRace($race);
                    $racestat->setPoint($calculatePointsService->calculatePoints($racestat));
                    $entityManager->persist($racestat);
                    $entityManager->flush();
                }else{
                    $racestat = $entityManager->getRepository(Racestat::class)->findOneBy(['race' => $race_id, 'pilot' => $form->getData()[$i]->getId()]);

                    $racestat->setPilot($form->getData()[$i]);
                    $racestat->setPlace($i);
                    $racestat->setRace($race);
                    $racestat->setPoint($calculatePointsService->calculatePoints($racestat));
                    $entityManager->flush();
                }


            }
        }



        return $this->render('admin/racestat/update.html.twig', [
            'form' => $form->createView(),
            'race' => $race
        ]);

    }
}

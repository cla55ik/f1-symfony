<?php

namespace App\Controller\Admin;

use App\Entity\Comand;
use App\Form\ComandFormType;
use App\Repository\ComandRepository;
use App\Service\FileUploadService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/comand', name: 'admin_comand')]
class ComandController extends AbstractController
{
    #[Route('', name: '')]
    public function index(ComandRepository $comandRepository): Response
    {
        $comands = $comandRepository->findAll();
        return $this->render('admin/comand/index.html.twig', [
            'comands' => $comands
        ]);
    }

    #[Route('/create', name: '_create')]
    public function createComand(Request $request, EntityManagerInterface $entityManager, FileUploadService $fileUploadService): Response
    {
        //TODO: проверка на Admin
        //TODO: проверка на Существование записи с таким Названием
        $comand = new Comand();
        $form = $this->createForm(ComandFormType::class, $comand);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $comand = $form->getData();

            $imgFile = $form->get('img')->getData();

            if ($imgFile){
                $comand->setImg($fileUploadService->upload($imgFile, Comand::IMG_UPLOAD_DIR));
            }

            if (empty($entityManager->getRepository(Comand::class)->findBy(['name'=>$form->getData()->getName()]))){
                $entityManager->persist($comand);
                $entityManager->flush();
            }else{
                $this->addFlash('error','Duplicate name');
            }

        }

        return $this->render('admin/comand/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/update/{id}', name: '_update')]
    public function updateComand($id, ComandRepository $comandRepository, Request $request, FileUploadService $fileUploadService, EntityManagerInterface $entityManager): Response
    {
        $comand = $comandRepository->find($id);
        $form = $this->createForm(ComandFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $comand->setName($data->getName());

            $imgFile = $form->get('img')->getData();
            if ($imgFile){
                $comand->setImg($fileUploadService->upload($imgFile, Comand::IMG_UPLOAD_DIR));
            }

            $entityManager->persist($comand);
            $entityManager->flush();
        }

        return $this->render('admin/comand/update.html.twig', [
            'form'=>$form->createView(),
            'comand'=>$comand
        ]);

    }

    #[Route('/delete/{id}', name: '_delete', requirements: ['id' => '\d+'])]
    public function deleteComand($id, ComandRepository $comandRepository, EntityManagerInterface $entityManager): Response
    {
        $comand = $comandRepository->find($id);
        $entityManager->remove($comand);
        $entityManager->flush();

        return $this->redirectToRoute('admin_country');
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use App\Form\CountryFormType;
use App\Repository\CountryRepository;
use App\Service\FileUploadService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/country', name: 'admin_country')]
class CountryController extends AbstractController
{
    #[Route('', name: '')]
    public function index(CountryRepository $countryRepository): Response
    {
        $countries = $countryRepository->findAll();
        return $this->render('admin/country/index.html.twig', [
            'countries' => $countries
        ]);
    }

    #[Route('/create', name: '_create')]
    public function createCountry(Request $request, EntityManagerInterface $entityManager, FileUploadService $fileUploadService): Response
    {
        //TODO: проверка на Admin
        $country = new Country();
        $form = $this->createForm(CountryFormType::class, $country);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $country = $form->getData();

            $imgFile = $form->get('img')->getData();

            if ($imgFile){
                $country->setImg($fileUploadService->upload($imgFile, Country::IMG_UPLOAD_DIR));
            }

            if (empty($entityManager->getRepository(Country::class)->findBy(['name'=>$form->getData()->getName()]))){
                $entityManager->persist($country);
                $entityManager->flush();
            }else{
                $this->addFlash('error','Duplicate name');
            }

        }

        return $this->render('admin/country/create.html.twig', [
            'form' => $form->createView()
        ]);

    }

    #[Route('/update/{id}', name: '_update')]
    public function updateCountry($id, CountryRepository $countryRepository, Request $request, FileUploadService $fileUploadService, EntityManagerInterface $entityManager): Response
    {
        $country = $countryRepository->find($id);
        $form = $this->createForm(CountryFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $country->setName($data->getName());

            $imgFile = $form->get('img')->getData();
            if ($imgFile){
                $country->setImg($fileUploadService->upload($imgFile, Country::IMG_UPLOAD_DIR));
            }

            $entityManager->persist($country);
            $entityManager->flush();
        }

        return $this->render('admin/country/update.html.twig', [
            'form'=>$form->createView(),
            'country'=>$country
        ]);

    }

    #[Route('/delete/{id}', name: '_delete', requirements: ['id' => '\d+'])]
    public function deleteCountry($id, CountryRepository $countryRepository, EntityManagerInterface $entityManager): Response
    {
        $country = $countryRepository->find($id);
        $entityManager->remove($country);
        $entityManager->flush();

        return $this->redirectToRoute('admin_country');
    }
}

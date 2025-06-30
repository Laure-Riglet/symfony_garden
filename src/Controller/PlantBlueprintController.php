<?php

namespace App\Controller;

use App\Entity\PlantBlueprint;
use App\Form\PlantBlueprintForm;
use App\Repository\PlantBlueprintRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/plant/blueprint')]
final class PlantBlueprintController extends AbstractController
{
    #[Route(name: 'app_plant_blueprint_index', methods: ['GET'])]
    public function index(PlantBlueprintRepository $plantBlueprintRepository): Response
    {
        return $this->render('plant_blueprint/index.html.twig', [
            'plant_blueprints' => $plantBlueprintRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plant_blueprint_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plantBlueprint = new PlantBlueprint();
        $form = $this->createForm(PlantBlueprintForm::class, $plantBlueprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plantBlueprint);
            $entityManager->flush();

            return $this->redirectToRoute('app_plant_blueprint_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plant_blueprint/new.html.twig', [
            'plant_blueprint' => $plantBlueprint,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plant_blueprint_show', methods: ['GET'])]
    public function show(PlantBlueprint $plantBlueprint): Response
    {
        return $this->render('plant_blueprint/show.html.twig', [
            'plant_blueprint' => $plantBlueprint,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plant_blueprint_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlantBlueprint $plantBlueprint, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlantBlueprintForm::class, $plantBlueprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plant_blueprint_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plant_blueprint/edit.html.twig', [
            'plant_blueprint' => $plantBlueprint,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plant_blueprint_delete', methods: ['POST'])]
    public function delete(Request $request, PlantBlueprint $plantBlueprint, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plantBlueprint->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($plantBlueprint);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plant_blueprint_index', [], Response::HTTP_SEE_OTHER);
    }
}

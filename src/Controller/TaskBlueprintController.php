<?php

namespace App\Controller;

use App\Entity\TaskBlueprint;
use App\Form\TaskBlueprintForm;
use App\Repository\TaskBlueprintRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/task/blueprint')]
final class TaskBlueprintController extends AbstractController
{
    #[Route(name: 'app_task_blueprint_index', methods: ['GET'])]
    public function index(TaskBlueprintRepository $taskBlueprintRepository): Response
    {
        return $this->render('task_blueprint/index.html.twig', [
            'task_blueprints' => $taskBlueprintRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_task_blueprint_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $taskBlueprint = new TaskBlueprint();
        $form = $this->createForm(TaskBlueprintForm::class, $taskBlueprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($taskBlueprint);
            $entityManager->flush();

            return $this->redirectToRoute('app_task_blueprint_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task_blueprint/new.html.twig', [
            'task_blueprint' => $taskBlueprint,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_blueprint_show', methods: ['GET'])]
    public function show(TaskBlueprint $taskBlueprint): Response
    {
        return $this->render('task_blueprint/show.html.twig', [
            'task_blueprint' => $taskBlueprint,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_task_blueprint_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TaskBlueprint $taskBlueprint, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaskBlueprintForm::class, $taskBlueprint);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_task_blueprint_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task_blueprint/edit.html.twig', [
            'task_blueprint' => $taskBlueprint,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_task_blueprint_delete', methods: ['POST'])]
    public function delete(Request $request, TaskBlueprint $taskBlueprint, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taskBlueprint->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($taskBlueprint);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_task_blueprint_index', [], Response::HTTP_SEE_OTHER);
    }
}

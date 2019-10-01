<?php

namespace App\Controller;

use App\Entity\Match;
use App\Entity\MatchType;
use App\Form\MatchesType;
use App\Repository\MatchRepository;
use App\Repository\MatchTypesRepository;
use App\Service\MatchTypesService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

/**
 * @Route("/match/types")
 */
class MatchTypesController extends AbstractController
{
    /**
     * @Route("/", name="match_types_index", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param MatchRepository $matchRepository
     * @param MatchTypesService $matchTypesService
     * @return Response
     */
    public function index(
        Request $request,
        MatchRepository $matchRepository,
        MatchTypesService $matchTypesService
    ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $matches = new Match();
        foreach ($matchRepository->findAll() as $match) {
            $matchTypeSaved = $match->getMatchTypesByUser($this->getUser());

            $matchType = new MatchType();
            $matchType->setMatchGame($match);

            if($matchTypeSaved instanceof MatchType) {
                $matchType->setGoalsHome($matchTypeSaved->getGoalsHome());
                $matchType->setGoalsAway($matchTypeSaved->getGoalsAway());
            }
            $matches->getMatchTypes()->add($matchType);
        }

        $form = $this
            ->createForm(MatchesType::class, $matches)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $matchTypes = $form->getData()->getMatchTypes()->toArray();

            try {
                $matchTypesService->setTypes($matchTypes, $this->getUser());
            } catch (Exception $e) {
                $this->addFlash('notice', $e->getMessage());
                $this->redirectToRoute('match_types_index');
            }

        }

        return $this->render('match_types/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="match_types_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $matchType = new MatchType();
        $form = $this->createForm(MatchTypesType::class, $matchType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($matchType);
            $entityManager->flush();

            return $this->redirectToRoute('match_types_index');
        }

        return $this->render('match_types/new.html.twig', [
            'match_type' => $matchType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="match_types_show", methods={"GET"})
     */
    public function show(MatchType $matchType): Response
    {
        return $this->render('match_types/show.html.twig', [
            'match_type' => $matchType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="match_types_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MatchType $matchType): Response
    {
        $form = $this->createForm(MatchTypesType::class, $matchType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('match_types_index');
        }

        return $this->render('match_types/edit.html.twig', [
            'match_type' => $matchType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="match_types_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MatchType $matchType): Response
    {
        if ($this->isCsrfTokenValid('delete' . $matchType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($matchType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('match_types_index');
    }
}

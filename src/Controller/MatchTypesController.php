<?php

namespace App\Controller;

use App\Entity\Match;
use App\Entity\MatchType;
use App\Entity\Queue;
use App\Entity\Season;
use App\Form\MatchesType;
use App\Repository\MatchRepository;
use App\Repository\MatchTypesRepository;
use App\Repository\QueueRepository;
use App\Repository\SeasonRepository;
use App\Repository\UserTableRepository;
use App\Service\MatchTypesService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

/**
 * @Route("/typer")
 */
class MatchTypesController extends AbstractController
{
    /**
     * @Route("/matches/{queue}/", name="match_types_index", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param MatchRepository $matchRepository
     * @param QueueRepository $queueRepository
     * @param SeasonRepository $seasonRepository
     * @param MatchTypesService $matchTypesService
     * @param int $queue
     * @return Response
     */
    public function index(
        Request $request,
        MatchRepository $matchRepository,
        QueueRepository $queueRepository,
        SeasonRepository $seasonRepository,
        MatchTypesService $matchTypesService,
        int $queue
    ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        if($queue > 0) {
            $matches = $matchTypesService->getMatchesFromQueue($queue, $matchRepository, $user);
        } else {
            $matches = $matchTypesService->getAllMatches($matchRepository, $user);
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

        $queues = $queueRepository->getQueuesBySeason($seasonRepository->findOneByCurrent(1));

        return $this->render('match_types/index.html.twig', [
            'form' => $form->createView(),
            'queues' => $queues
        ]);
    }

    /**
     * @Route("/table", name="match_types_table", methods={"GET"})
     *
     * @param UserTableRepository $userTableRepository
     * @return Response
     */

    public function table(UserTableRepository $userTableRepository): Response {


        return $this->render('match_types/table.html.twig', [
            'table' => $userTableRepository->getTable()
        ]);

    }
}

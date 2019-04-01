<?php

namespace App\Controller;

use App\Entity\Race;
use App\Exception\RaceCreationException;
use App\Service\HorseCalculationService;
use App\Service\ParticipantCalculationService;
use App\Service\ParticipantManager;
use App\Service\RaceCalculationService;
use App\Service\RaceManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    const MAX_RACES = 3;

    const LAST_NUMBER = 5;

    /** @var HorseCalculationService $horseCalculationService */
    protected $horseCalculationService;

    /** @var ParticipantCalculationService $participantCalculationService */
    protected $participantCalculationService;

    /** @var RaceCalculationService $raceCalculationService */
    protected $raceCalculationService;

    /** @var ParticipantManager $participantManager */
    protected $participantManager;

    /** @var RaceManager $raceManager */
    protected $raceManager;

    /** @var EntityManager */
    protected $em;

    /**
     * DefaultController constructor.
     *
     * @param HorseCalculationService $horseCalculationService
     * @param ParticipantCalculationService $participantCalculationService
     * @param RaceCalculationService $raceCalculationService
     * @param ParticipantManager $participantManager
     * @param RaceManager $raceManager
     */
    public function __construct(
        HorseCalculationService $horseCalculationService,
        ParticipantCalculationService $participantCalculationService,
        RaceCalculationService $raceCalculationService,
        ParticipantManager $participantManager,
        RaceManager $raceManager
    )
    {
        $this->horseCalculationService = $horseCalculationService;
        $this->participantCalculationService = $participantCalculationService;
        $this->raceCalculationService = $raceCalculationService;
        $this->participantManager = $participantManager;
        $this->raceManager = $raceManager;

    }

    /**
     * Display index page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $this->em = $this->getDoctrine()->getManager();
        $raceRepository = $this->em->getRepository(Race::class);

        $activeRaces = $raceRepository->getActiveList();
        $lastRaces = $raceRepository->getLastFinished(self::LAST_NUMBER);
        $bestRace = $raceRepository->getBestRace();

        return $this->render('index.html.twig', [
            'activeRaces' => $activeRaces,
            'lastRaces' => $lastRaces,
            'bestRace' => $bestRace
        ]);
    }

    /**
     * Proceed race
     *
     * @param $raceId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \App\Exception\RaceNotFoundException
     */
    public function proceed($raceId)
    {
        $race = $this->raceManager->getById($raceId);

        $this->raceCalculationService->proceed($race);

        $this->raceManager->updateState($race);

        return $this->redirectToRoute('index');
    }

    /**
     * Create new race
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws RaceCreationException
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function create()
    {
        /** @var ArrayCollection $races */
        $races = $this->em->getRepository(Race::class)->getActiveList();

        if ($races->count() >= self::MAX_RACES) {
            return $this->redirectToRoute('index');
        }

        $participants = $this->participantManager->prepareParticipants(Race::NUMBER_OF_PARTICIPANTS);

        $this->raceManager->create($participants);

        return $this->redirectToRoute('index');

    }
}
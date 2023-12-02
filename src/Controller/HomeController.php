<?php

namespace App\Controller;

use App\Repository\ChantRepository;
use App\Repository\SecliRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        private ChantRepository $chantRepository,
        private SecliRepository $secliRepository,
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $stat[0] = $this->chantRepository->countAll();
        $stat[1] = $this->secliRepository->countAll();
        $stat[2] = $this->secliRepository->countAllImp();

        return $this->render('home/index.html.twig', [
            'stat' => $stat,
        ]);
    }
}

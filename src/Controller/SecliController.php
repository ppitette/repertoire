<?php

namespace App\Controller;

use App\Entity\RepSearch;
use App\Form\RepSearchType;
use App\Repository\SecliRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/secli')]
// #[IsGranted('ROLE_ADMIN')]
class SecliController extends AbstractController
{
    #[Route('/', name: 'app_secli_index')]
    public function index(PaginatorInterface $paginator, SecliRepository $secliRepository, Request $request): Response
    {
        $search = new RepSearch();
        $form = $this->createForm(RepSearchType::class, $search);
        $form->handleRequest($request);

        $fiches = $paginator->paginate(
            $secliRepository->findFiche($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('secli/index.html.twig', [
            'fiches' => $fiches,
            'form' => $form,
        ]);
    }
}

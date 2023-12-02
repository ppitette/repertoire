<?php

namespace App\Controller;

use App\Entity\Chant;
use App\Entity\Secli;
use App\Form\ChantType;
use App\Repository\ChantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/chant')]
class ChantController extends AbstractController
{
    public function __construct(
        private ChantRepository $chantRepository,
        private EntityManagerInterface $em,
    ) {
    }

    #[Route('/', name: 'app_chant_index', methods: ['GET'])]
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $chants = $paginator->paginate(
            $this->chantRepository->findAllOrderTitre(),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('chant/index.html.twig', [
            'chants' => $chants,
        ]);
    }

    #[Route('/new', name: 'app_chant_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $chant = new Chant();
        $form = $this->createForm(ChantType::class, $chant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->chantRepository->save($chant, true);

            return $this->redirectToRoute('app_chant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chant/new.html.twig', [
            'chant' => $chant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chant_show', methods: ['GET'])]
    public function show(Chant $chant): Response
    {
        return $this->render('chant/show.html.twig', [
            'chant' => $chant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_chant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chant $chant): Response
    {
        $form = $this->createForm(ChantType::class, $chant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->chantRepository->save($chant, true);

            return $this->redirectToRoute('app_chant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('chant/edit.html.twig', [
            'chant' => $chant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chant_delete', methods: ['POST'])]
    public function delete(Request $request, Chant $chant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chant->getId(), $request->request->get('_token'))) {
            $this->chantRepository->remove($chant, true);
        }

        return $this->redirectToRoute('app_chant_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id<\d+>}/import', name: 'app_chant_import')]
    public function import(Secli $secli, Request $request): Response
    {
        $chant = new Chant();

        $chant->setTitre(strtolower($secli->getTitre()));
        $chant->setCote($secli->getCote());
        $chant->setCotenew($secli->getCoteNew());
        $chant->setAnnee($secli->getAnnee());
        if ('1900' == $secli->getAnnee()) {
            $chant->setAnnee(null);
        }
        $chant->setSnpls($secli->getSnpls());
        $chant->setSecli($secli->getFiche());

        $secli->setImporte(true);

        $form = $this->createForm(ChantType::class, $chant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($chant);
            $this->em->flush();

            $this->em->persist($secli);

            return $this->redirectToRoute('app_secli_index');
        }

        return $this->render('chant/import.html.twig', [
            'secli' => $secli,
            'chant' => $chant,
            'form' => $form,
        ]);
    }
}

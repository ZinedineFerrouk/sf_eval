<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Salle;
use App\Form\SalleFormType;
use App\Form\ShowType;
use App\Repository\MovieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private MovieRepository $movieRepo;

    public function __construct(MovieRepository $movieRepo)
    {
        $this->movieRepo = $movieRepo;
    }

    #[Route('/', name: 'app_home', methods: ["GET"])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'shows' => $this->movieRepo->findAll(),
        ]);
    }

    #[Route('/get-all', name: 'app_get_all', methods: ["GET"])]
    public function getAll(): Response
    {
        return $this->json($this->movieRepo->findAll(), 200);
    }

    #[Route('/get-show/{id}', name: 'app_get_all', methods: ["GET"])]
    public function getOneShow(int $id): Response
    {
        return $this->json($this->movieRepo->findOneBy(['id' => $id]), 200);
    }

    #[Route('/show/{name}', name: 'app_show_details')]
    public function show($name): Response
    {
        return $this->render('home/show.html.twig', [
            'show' => $this->movieRepo->findOneBy(['name' => $name]),
        ]);
    }

    #[Route('/new/show', name: 'app_create_show', methods: ["GET", "POST"])]
    public function new_show(Request $request): JsonResponse
    {
        try {
            $content = json_decode($request->getContent(), true);
            $show = (new Movie())
                ->setName($content['name'])
                ->setType($content['type'])
                ->setSynopsis($content['synopsis'])
                ->setGenre($content['genre'])
                ->setStudio($content['studio'])
                ->setCreatedAt(new \DateTimeImmutable('now'))
            ;

            $this->movieRepo->save($show, true);
            return $this->json('Votre show a bien été ajouter.', 201);
        } catch ( \Exception $exception) {
            return $this->json('Erreur lors de la création d\'un show', 400);
        }
    }

    #[Route('/create/show', name: 'app_create_show', methods: ["GET", "POST"])]
    public function create_show(Request $request)
    {
        $show = new Movie();
        $form = $this->createForm(ShowType::class, $show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $showData = $form->getData();

            $show
                ->setName($showData->getName())
                ->setType($showData->getType())
                ->setSynopsis($showData->getSynopsis())
                ->setGenre($showData->getGenre())
                ->setStudio($showData->getStudio())
                ->setCreatedAt(new \DateTimeImmutable('now'))
            ;

            $this->movieRepo->save($show, true);
            return $this->redirect('/');
        }

        return $this->render('home/create_show.html.twig', [
            'show' => $show,
            'form' => $form->createView()
        ]);
    }
}

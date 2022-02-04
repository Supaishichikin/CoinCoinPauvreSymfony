<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Photos;
use App\Entity\Tags;
use App\Form\AnnonceFormType;
use App\Repository\AnnonceRepository;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use App\Repository\UserRepository;
use App\Service\UploadHelper;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     * @param Request $request
     * @param AnnonceRepository $repository
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function homepage(Request $request, AnnonceRepository $repository, PaginatorInterface $paginator): Response
    {
        $text = 'CoinCoinPauvre';

        $query = $repository->createQueryBuilder('a')
                            ->orderBy('a.date_de_publication', 'DESC')
                            ->innerJoin('a.user', 'user')
                            ->addSelect('user')
                            ->getQuery()
                            ->getResult();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            10
        );


        return $this->render('annonce/homepage.html.twig', ['text' => $text, 'annonces' => $pagination, 'j' => 0]);
    }

    /**
     * @Route("/annonce/{id<\d+>}", name="app_detail_annonce")
     * @param AnnonceRepository $annonceRepository
     * @param $id
     * @param Request $request
     * @param QuestionRepository $questionRepository
     * @param ReponseRepository $reponseRepository
     * @return Response
     */
    public function detailAnnonce(AnnonceRepository $annonceRepository, $id, Request $request,
                   QuestionRepository $questionRepository, ReponseRepository $reponseRepository): Response
    {
        $annonce = $annonceRepository->findOneBy(['id' => $id]);


        if($request->getMethod() == 'POST'){
            // todo enregistrement questions/réponses
        }

        return $this->render('annonce/detailAnnonce.html.twig', ['annonce' => $annonce, 'j' => 0]);
    }

    /**
     * @Route("/search-annonce", name="search-annonce")
     * @param AnnonceRepository $repository
     * @param Request $request
     * @return Response
     */
    public function searchAnnonce(AnnonceRepository $repository, Request $request): Response
    {
        $search = $request->query->get('q');

        $annonces = $repository->findBySearchTerms($search);

        return $this->render('annonce/searchAnnonce.html.twig', ['annonces' => $annonces, 'j' => 0]);
    }

    /**
     * @Route("/create-annonce/{user_id}", name="create-annonce")
     * @return Response
     */
    public function createAnnonce( Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager
        ,$user_id, UploadHelper $helper)
    {
        $form = $this->createForm(AnnonceFormType::class);

        $user = $userRepository->findOneBy(['id' => $user_id]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $arrayTags = array_unique(explode( ',', $request->request->get('annonce_form')['tags']));
            $annonce = new Annonce();

            $annonce->setTitre($data->getTitre())
                ->setDescription($data->getDescription())
                ->setPrix($data->getPrix())
                ->setUser($user)
                ->setDateDePublication(new \DateTime());

            foreach ($arrayTags as $stringTag){
                try {
                    $tag = new Tags();
                    $tag->setLibelle($stringTag);


                    $annonce->addTag($tag);
                    $entityManager->persist($tag);
                    $entityManager->flush();

                }catch (UniqueConstraintViolationException $ex){
                    $tag = $entityManager->getRepository(Tags::class)->findOneBy(['libelle' => $stringTag]);
                    $annonce->addTag($tag);
                    $this->getDoctrine()->resetManager();
                }
            }



            $entityManager->persist($annonce);

            $image = $request->files->get('annonce_form')['image'];
            if($image){
                $photos = new Photos();
                $newFile = $image;
                if($newFile){
                    $fileName = $helper->uploadAnnonceImage($newFile);
                    $photos->setFilePath($fileName);
                    $photos->setAnnonce($annonce);
                    $annonce->addPhoto($photos);
                    $entityManager->persist($photos);

                }
            }
            $entityManager->flush();


            $this->addFlash('success', 'Nice nouvelle annonce !');

            //return $this->redirectToRoute($this->generateUrl('app_homepage'));
        }

        return $this->render('annonce/createAnnonce.html.twig', ['annonceForm' => $form->createView()]);
    }
}
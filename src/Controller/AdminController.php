<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AnnonceFormType;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        
        return $this->render('admin/index.html.twig', [
            'text' => 'Hello World !',
        ]);
    }

   // /**
   //  * @Route("/admin/test/create-annonce", name="admin_test_create_annonce")
   //  */
    /*public function testCreateAnnonce(Request $request, AnnonceRepository $annonceRepository){

        $form = $this->createForm(AnnonceFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $annonce = new Annonce();
            $annonce->setTitre($data['titre'])
                ->setDescription($data['description'])
                ->setPrix($dataPrix)
                ->
        }

        return $this->render('admin/testCreateAnnonce.html.twig', ['annonceForm' => $form->createView()]);
    }*/
}

<?php

namespace App\Controller\Back\ListUsers;

use App\Entity\User;
use App\Form\Recherche\RechercheType;
use App\Repository\UserRepository;
use App\Services\GetUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ListCoachsController extends AbstractController
{
    /**
     * @Route("/list/clients", name="list_clients")
     */
    public function index(): Response
    {
        return $this->render('Back/list_coachs/listeClients.html.twig', [
            'controller_name' => 'ListClientsController',
        ]);
    }
    /**
     * @return Response
     * @Route("/coachs",name="lists_coachs")
     */


    public function afficher(Request $request,GetUser $getUser)
    {   $entityManager = $this->getDoctrine()->getManager();
        $getUser->Get_User()->setNotifyAddCoach('N');
        $entityManager->flush();



        $form = $this->createForm(RechercheType::class);
        $form->handleRequest($request);


        $User = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => array('CoachV','CoachNV')],
        );

        if($form->isSubmitted()){

            $inputRecherche = $form->get('inputRecherche')->getData();
            $critere =$form->get('critere')->getData();


            $User = $this->getDoctrine()->getRepository(User::class)->findBy(
                [$critere =>$inputRecherche,'role' => array('CoachV','CoachNV')]

            );
        }

        return $this->render("Back/list_coachs/listeCoachs.html.twig", [

            'users' => $User,'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/verifierCoach/{id}",name="verifierCoach")
     * @param $id
     */


    public function verifierCoach($id)
    {


        $User = $this->getDoctrine()->getRepository(User::class)->find($id);

        $User->setRole("CoachV");
        $User->setRoles(array('ROLE_COACHV'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('lists_coachs');

    }
    /**
     * @Route("/non_verifierCoach/{id}",name="non_verifierCoach")
     * @param $id
     */


    public function non_verifierCoach($id)
    {


        $User = $this->getDoctrine()->getRepository(User::class)->find($id);
        $User->setRole("CoachNV");
        $User->setRoles(array('ROLE_COACHNV'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        return $this->redirectToRoute('lists_coachs');

    }




}

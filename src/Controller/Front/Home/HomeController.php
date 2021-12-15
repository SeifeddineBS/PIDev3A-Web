<?php

namespace App\Controller\Front\Home;

use App\Entity\User;
use App\Services\GetUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param GetUser $getUser
     * @return Response
     */
    public function index(GetUser $getUser): Response
    {
        if($getUser->Get_User())

    {   $user=$getUser->Get_User();
        if($user->getRole()=='CoachNV' ||$user->getRole()=='CoachV' ||($user->getRole()=='Admin')||($user->getRole()=='SAdmin'))
    {

        $clientsArray = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => 'Client']);
        $clients=sizeof($clientsArray);

        $coachVArray = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => 'CoachV']);
        $coachV=sizeof($coachVArray);

        $coachNVArray = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => 'CoachNV']);
        $coachNV=sizeof($coachNVArray);
        return $this->render('Back/Home/home.html.twig', [
            'controller_name' => 'HomeController',
            'clients'=>$clients,'coachsV'=>$coachV,'coachsNV'=>$coachNV

        ]);



    }}
        return $this->render('Front/Home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);

    }
}

<?php

namespace App\Controller\Back\Home;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/HomeBack", name="HomeBack")
     */
    public function index(): Response
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
    }

    /**
     * @Route("/statsUsers", name="statsUsers")
     */
    public function statsUsers(): Response
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


        return $this->render('Back/Home/statsUsers.html.twig', [
            'controller_name' => 'HomeController',
            'clients'=>$clients,'coachsV'=>$coachV,'coachsNV'=>$coachNV
        ]);
    }


    /**
     * @Route("/statsCoachs", name="statsCoachs")
     */
    public function statsCoachs(): Response
    {


        $coachVArray = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => 'CoachV']);
        $coachV=sizeof($coachVArray);

        $coachNVArray = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => 'CoachNV']);
        $coachNV=sizeof($coachNVArray);


        return $this->render('Back/Home/statsCoachs.html.twig', [
            'controller_name' => 'HomeController',
            'coachsV'=>$coachV,'coachsNV'=>$coachNV
        ]);
    }
}

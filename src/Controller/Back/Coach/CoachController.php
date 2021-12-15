<?php

namespace App\Controller\Back\Coach;


    use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Services\MailerService;



class CoachController extends AbstractController
{

    /**
     * @Route("/Coach", name="Coach")
     */
    public function index(): Response
    {
        return $this->render('Back/Coach/login.html.twig', [
            'controller_name' => 'CoachController',
        ]);
    }


    /**
     * @Route("/Coach/sendMailCoachNV", name="sendMailCoachNV")
     * @param MailerService $mailerService
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function sendMailCoachNV(MailerService $mailerService): Response
    {

        $mailerService->send("Verification d'un Coach","aura.forgetPass@gmail.com","seifeddine.bensalah@gmail.com","Email/emailCoachNV.html.twig",[]);
        return $this->redirectToRoute('HomeBack');


    }










}

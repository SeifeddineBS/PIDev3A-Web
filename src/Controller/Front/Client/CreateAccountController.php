<?php

namespace App\Controller\Front\Client;

use App\Entity\User;
use App\Form\Client\ClientAddType;
use App\Repository\UserRepository;
use App\Services\MailerService;
use App\Services\MaLocalisation;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

use Gedmo\Sluggable\Util\Urlizer;




class CreateAccountController extends AbstractController
{


    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;


    }


    /**
     * @param Request $request
     * @param MaLocalisation $maLocalisation
     * @param GoogleAuthenticatorInterface $googleAuthenticatorService
     * @param MailerService $mailerService
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @Route("/Client/CreateAccount", name="ClientCreateAccount")
     */


    function ajouter(Request $request,MaLocalisation $maLocalisation,GoogleAuthenticatorInterface $googleAuthenticatorService,MailerService $mailerService)
    {
        $user = new User();

        $form = $this->createForm(ClientAddType::class, $user);



        $user->setRole("ClientN");
        $user->setRoles(array('ROLE_CLIENTN'));
        $user->setSpecialite('');
        $form->getData()->setSpecialite("NULL");
        $form->setData($form->getData());

        $form->handleRequest($request);

        $file = $form->get('picture')->getData();

        if($file)
        {
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('pictures_directory'), $fileName);
            $user->setPicture($fileName);
        }




        if ($form->isSubmitted() && $form->isValid()) {


                $user->setAdresse($maLocalisation->MaLocalisation());
                $token=md5(uniqid());
                $user->setActivationToken($token);
                $mailerService->send(
                "Bienvenue sur notre site",
                "aura.forgetPass@gmail.com",
                $form->get('email')->getData(),
                "Email/emailClientNV.html.twig",['token'=>$token]);

            $file = $form->get('picture')->getData();

            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('pictures_directory'), $fileName);
                $user->setPicture($fileName);
            }
            else{
                $user->setPicture('default.jpg');
            }
            $secret = $googleAuthenticatorService->generateSecret();
            $user->setGoogleAuthenticatorSecret($secret);

            $password = $form->getData()->getPassword();


            $form->getData()->setPassword($this->encoder->encodePassword($user, $password));


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash("info", "Verifier votre courrier pour activer votre compte ");

                return $this->redirectToRoute('loginFront');
        }
        return $this->render('Front/Client/CreateAccount/createAccount.html.twig',
            ['form' => $form->createView()
            ]);

    }


    /**
     * @Route("/activation/{token}",name="activation")
     */
    public function activation($token,UserRepository $userRepository)
    {
        $user = new User();
        $user = $userRepository->findOneBy(['activation_token' => $token]);
        if (!$user) {


            return $this->redirectToRoute("loginFront");
        }

        $user->setActivationToken(null);
        $user->setRole("Client");
        $user->setRoles(array('ROLE_CLIENT'));

        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $this->addFlash("info", "Votre Compte est active");


        return $this->redirectToRoute("loginFront");

    }


}

<?php

namespace App\Controller\Back\Coach;

use App\Entity\User;
use App\Form\Coach\CoachAddType;
use App\Services\SmsService;
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

    public function notifyAddCoach()
    {       $em = $this->getDoctrine()->getManager();
        $Users = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => array('Admin','SAdmin')],
        );
        if($Users){

            foreach ($Users as $User){

                $User->setNotifyAddCoach('Y');
                $em->flush();
            }


        }


    }



    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/Coach/CreateAccount", name="CoachCreateAccount")
     */


    function ajouter(Request $request,GoogleAuthenticatorInterface $googleAuthenticatorService,SmsService $smsService)
    {
        $user = new User();

        $form = $this->createForm(CoachAddType::class, $user);



        $user->setRole("CoachNV");
        $user->setRoles(array('ROLE_COACHNV'));
        $form->getData()->setAdresse("NULL");
        $form->setData($form->getData());

        $user->setAdresse('');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



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
            $this->notifyAddCoach();

            $smsService->sendSms(
                "+21695227678",
                "Salut un nouveau coach vient de s'inscrire a notre site veuillez verifiez"

            );


            return $this->redirectToRoute('loginFront');
        }
        return $this->render('Back/Coach/CreateAccount/createAccount.html.twig',
            ['form' => $form->createView()
            ]);


    }
}

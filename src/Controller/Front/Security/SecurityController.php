<?php

namespace App\Controller\Front\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\GetUserById;
use App\Services\UpdateRoles;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Google\GoogleAuthenticatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $user;
    private $updateRole;

    public function __construct(UpdateRoles $updateRoles)
    {
        $this->updateRole=$updateRoles;
    }


    /**
     * @Route("/Login", name="loginFront")
     * @param Request $request
     * @param AuthenticationUtils $utils
     * @return Response
     */
    public function login(Request $request,AuthenticationUtils $utils): Response
    {
        $this->user= new User();
        $error=$utils->getLastAuthenticationError();
        $last_id=$utils->getLastUsername();
        $this->updateRole->updateRoles();


        return $this->render('Front/Security/login.html.twig', [
            'error' => $error,
            'last_id'=> $last_id

        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){


    }

    /**
     * @Route("/2fa", name="2fa_login")
     */
    public function check2fa(GoogleAuthenticatorInterface $authenticator,TokenStorageInterface $storage){
        $code=$authenticator->getQRContent($storage->getToken()->getUser());
        $qrCode="http://chart.apis.google.com/chart?cht=qr&chs=150x150&chl=".$code;
        return $this->render('Front/Security/2fa_login.html.twig',[
            'qrCode'=>$qrCode


            ]);



    }

}

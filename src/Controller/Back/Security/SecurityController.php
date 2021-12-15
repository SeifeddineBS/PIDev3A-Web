<?php

namespace App\Controller\Back\Security;

use App\Entity\User;
use App\Services\UpdateRoles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $user;
    private UpdateRoles $updateRole;

    public function __construct(UpdateRoles $updateRoles)
    {
        $this->updateRole=$updateRoles;
    }


    /**
     * @Route("/LoginBack", name="loginBack")
     */
    public function login(Request $request,AuthenticationUtils $utils): Response
    {
        $this->user= new User();
        $error=$utils->getLastAuthenticationError();
        $last_id=$utils->getLastUsername();
        $this->updateRole->updateRoles();



        return $this->render('Back/Security/login.html.twig', [
            'error' => $error,
            'last_id'=> $last_id

        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){


    }

}

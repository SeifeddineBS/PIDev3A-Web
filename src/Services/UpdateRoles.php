<?php


namespace App\Services;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UpdateRoles extends AbstractController
{
public function updateRoles()
{
    $em = $this->getDoctrine()->getManager();

    $Users = $this->getDoctrine()->getRepository(User::class)->findBy(
        ['role' => array('CoachV','CoachNV','Admin','Client')],
    );
    if($Users)
    {
        foreach ($Users as $User){
            if($User->getRole()=='Client' && $User->getRoles()[0]=='ROLE_USER')
            {
                $User->setRoles(array('ROLE_CLIENT'));
                $em->flush();

            }

            if($User->getRole()=='CoachNV'&& $User->getRoles()[0]=='ROLE_USER')
            {
                $User->setRoles(array('ROLE_COACHNV'));
                $em->flush();
            }
            if($User->getRole()=='CoachV'&& $User->getRoles()[0]=='ROLE_USER')
            {
                $User->setRoles(array('ROLE_COACHV'));
                $em->flush();
            }
            if($User->getRole()=='CoachV')
            {
                $User->setRoles(array('ROLE_COACHV'));
                $em->flush();
            }
            if($User->getRole()=='Admin'&& $User->getRoles()[0]=='ROLE_USER')
            {
                $User->setRoles(array('ROLE_ADMIN'));
                $em->flush();
            }
            if($User->getRole()=='SAdmin'&& $User->getRoles()[0]=='ROLE_USER')
            {
                $User->setRoles(array('ROLE_ADMIN'));
                $em->flush();
            }


        }}








}
}
<?php

namespace App\Controller\Back\ListUsers;

use App\Entity\User;
use App\Form\Recherche\RechercheType;
use phpDocumentor\Reflection\Types\Array_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class ListClientsController extends AbstractController
{
    /**
     * @Route("/list/clients", name="list_clients")
     */
    public function index(): Response
    {
        return $this->render('Back/list_clients/listeClients.html.twig', [
            'controller_name' => 'ListClientsController',
        ]);
    }


    /**
     * @return Response
     * @Route("/clients",name="lists_clients")
     */


    public function afficher(Request $request)
    {
        $form = $this->createForm(RechercheType::class);

        $User = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => 'Client']);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $inputRecherche = $form->get('inputRecherche')->getData();
              $critere =$form->get('critere')->getData();


            $User = $this->getDoctrine()->getRepository(User::class)->findBy(
                [$critere =>$inputRecherche,'role'=>'Client']

            );
        }
        return $this->render("Back/list_clients/listeClients.html.twig",[
            'users' => $User,
            'form' => $form->createView()

            ]);
    }


    /**
     * @return Response
     * @Route("/pdfClientsShow",name="pdfClientsShow")
     */


    public function showpdf()
    {
        $date=date("Y/m/d");


        $User = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => 'Client']);
        return $this->render("Back/list_clients/pdfClients.html.twig", [
            'users' => $User,
            'date'=>$date
        ]);
    }




    /**
     * @Route("/pdfClients",name="pdfClients")
     */

    public function pdf()
    {
        $User = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['role' => 'Client']);

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our twig file
        $date=date("Y/m/d");
        $html = $this->renderView("Back/list_clients/pdfClients.html.twig",[
            'users' => $User,
            'date'=>$date
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);


        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();


        // Output the generated PDF to Browser (force download)
        $dompdf->stream("ListeClients.pdf", [
            "Attachment" => true
        ]);
    }


}

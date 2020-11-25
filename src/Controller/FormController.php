<?php


namespace App\Controller;

use App\Entity\Donnees;
use App\Form\testForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form/new", name="page_form")
     */
    public function new(Request $request)
    {
        $donnees = new Donnees();
        $donnees->setTitle('Hello World');
        $donnees->setContent('Un très court article.');
        $donnees->setAuthor('Charlie');


        $form = $this->createForm(testForm::class, $donnees);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($donnees);
            $em->flush();
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
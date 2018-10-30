<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Stage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EntrepriseController extends Controller
{

    /**
     * @Route("/addstage", name="addstage")
     */
    public function addstageAction(Request $request)
    {
        $stage = new Stage();
        $form = $this->createForm('AppBundle\Form\StageType', $stage  );
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $stage->setIdEntreprise($this->getUser());


            $em = $this->getDoctrine()->getManager();
            $em->persist($stage);
            $em->flush();


            return $this->render('default/profil.html.twig' );
        }

        return $this->render('default/addstage.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/entrepriseshow", name="entrepriseshow")
     */
    public function entrepriseshowAction(Request $request)
    {

        return $this->render('default/entrepriseshow.html.twig',array('form' => $form ));
    }

}
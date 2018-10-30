<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function showAction(Request $request)
    {
        $allstages = $this->getDoctrine()
            ->getRepository('AppBundle:Stage')->findall();

        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/etudiant/passya", name="passya")
     */
    public function passyaAction()
    {
        return $this->render('default/passya.html.twig');
    }
}
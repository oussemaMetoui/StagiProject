<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Knowledge;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EtudiantController extends Controller
{

    /**
     * @Route("/profil", name="profil")
     */
    public function profilAction(Request $request)
    {
        $ajout_skill = $request->request->get('ajout_skill');

        $userskills = $this->getDoctrine()
            ->getRepository('AppBundle:Knowledge')
            ->findBy(array('idUser' => $this->getUser()));

        $allskills = $this->getDoctrine()
            ->getRepository('AppBundle:Skill')->findall();

        if($ajout_skill != NULL)
        {
            $skill = $this->getDoctrine()
                ->getRepository('AppBundle:Skill')
                ->findOneBy(array('skill' => $ajout_skill));

            var_dump($skill);

            $knowledge = new Knowledge();
            $knowledge->setIdUser($this->getUser());
            $knowledge->setIdSkill($skill);
            $em = $this->getDoctrine()->getManager();
            $em->persist($knowledge);
            $em->flush();

            return $this->render('default/profil.html.twig', array('userskills' => $userskills,'allskills' => $allskills));
        }

        return $this->render('default/profil.html.twig', array('userskills' => $userskills,'allskills' => $allskills));
    }

    /**
     * @Route("/cherchestage", name="cherchestage")
     */
    public function cherchestageAction(Request $request)
    {
        $stagename = $request->request->get('achercher');
        $staget = $this->getDoctrine()
            ->getRepository('AppBundle:Stage')->findOneBy(array('nomStage' => $stagename));

        return $this->render('default/cherchestage.html.twig', array('stagename' => $staget));
    }
}
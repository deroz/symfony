<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Troiswa\BackBundle\Entity\Genres;

class GenreController extends Controller
{
    public function allAction()
    {

        $em=$this->getDoctrine()->getManager();
        $genres=$em->getRepository("TroiswaBackBundle:Genres")->findAll();



        return $this->render("TroiswaBackBundle:Main:genre.html.twig", ["genres"=>$genres]);
    }

    public function creerAction(Request $request)//$_POST et $_GET
    {
        $nouveauGenre= new Genres();
       // $nouveauGenre->setType("essai");
        $form=$this->createFormBuilder($nouveauGenre)
                   ->add("type","text")
                   ->add("description","textarea")
                   ->add("ajouter","submit")
                   ->getForm();


            $form->handleRequest($request);
           // die(var_dump($nouveauGenre));
            if($form->isValid())
            {
                $em=$this->getDoctrine()->getManager();
                $em->persist($nouveauGenre);
                
                $em->flush();
                $sessions=$request->getSession();//message flash
                $sessions->getFlashBag()->add("success_genre", "Le Genre a bien été rajouté");
                return $this->redirect($this->generateUrl("troiswa_back_genre"));
            }


        return $this->render("TroiswaBackBundle:Main:creation.html.twig",["formGenre"=>$form->createView()]);
    }

    public function modifierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $nouveauGenre = $em->getRepository("TroiswaBackBundle:Genres")->find($id);
        $form = $this->createFormBuilder($nouveauGenre)
            ->add("type", "text")
            ->add("description", "textarea")
            ->add("ajouter", "submit")
            ->getForm();


        $form->handleRequest($request);
        // die(var_dump($nouveauGenre));
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nouveauGenre);

            $em->flush();
            $sessions = $request->getSession();//message flash
            $sessions->getFlashBag()->add("success_genre", "Le Genre a bien été modifié");
            return $this->redirect($this->generateUrl("troiswa_back_genre"));
        }


        return $this->render("TroiswaBackBundle:Main:modifier.html.twig", ["formGenre" => $form->createView()]);
    }


    public function supprimerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $Genre = $em->getRepository("TroiswaBackBundle:Genres")->find($id);

            $em = $this->getDoctrine()->getManager();

            $em->remove($Genre);
            $em->flush();

            $sessions = $request->getSession();//message flash
            $sessions->getFlashBag()->add("success_genre", "Le Genre a été supprimer");
            return $this->redirect($this->generateUrl("troiswa_back_genre"));




    }

}

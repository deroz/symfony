<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Troiswa\BackBundle\Entity\Acteurs;

class ActeurController extends Controller
{
    public function routeActeurAction()
    {
       /* $tousLesActeurs=[
            [
                "id"=>1,
                "prenom"=>"Tom",
                "nom"=>"Cruise",
                "sexe"=>"0"
            ],
            [
                "id"=>2,
                "prenom"=>"George",
                "nom"=>"Clooney",
                "sexe"=>"0"
            ],
            [
                "id"=>3,
                "prenom"=>"Will",
                "nom"=>"Smith",
                "sexe"=>"0"
            ],
            [
                "id"=>4,
                "prenom"=>"Scarlette",
                "nom"=>"Johansson",
                "sexe"=>"1"
            ],
        ];
        */


        $em=$this->getDoctrine()->getManager();//récuperation de doctrine $em(Entitie Manageur, connexion dans le projet)
        $tousLesActeurs=$em->getRepository("TroiswaBackBundle:Acteurs")->findAll();



        return $this->render("TroiswaBackBundle:Main:acteur.html.twig", ["tousLesActeurs"=>$tousLesActeurs]);
    }


    public function informationAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $unActeur=$em->getRepository("TroiswaBackBundle:Acteurs")->find($id);

         if(empty($unActeur))
         {
             throw $this->createNotFoundException("Cet Acteur N'Existe Pas");
         }

        return $this->render("TroiswaBackBundle:Main:infoActeur.html.twig", ["acteur"=>$unActeur]);
    }

    public function ajoutAction(Request $request)//$_POST et $_GET
    {
        $nouvelActeur = new Acteurs();
        // $nouvelActeur->setType("essai");
        $formActeur = $this->createFormBuilder($nouvelActeur)
            ->add('sexe', 'choice', array(
                'choices'   => array(0 => 'Homme', 1 => 'Femme'),
                'expanded'  => true,
            ))
            ->add("prenom", "text")
            ->add("nom", "text")
            ->add("ville", "text")
            ->add("dateNaissance", 'date', [
                'years' => range(date('Y')-100,date('Y'))
            ])
            ->add("fichier", "file",[
                "constraints"=>new NotBlank(
                    ["message"=>"Attention"]
                )
            ])
            ->add("biographie", "textarea")
            ->add("ajouter", "submit")
            ->getForm();


        $formActeur->handleRequest($request);
        // die(var_dump($nouvelActeur));
        if ($formActeur->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $nouvelActeur->upload();
            $em->persist($nouvelActeur);

            $em->flush();
            $sessions = $request->getSession();//message flash
            $sessions->getFlashBag()->add("success_acteur", "L'Acteur a bien été rajouté");
            return $this->redirect($this->generateUrl("troiswa_back_ajout_acteur"));
        }


        return $this->render("TroiswaBackBundle:Main:ajoutActeur.html.twig", ["formActeur" => $formActeur->createView()]);
    }

    public function modifierAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $nouvelActeur = $em->getRepository("TroiswaBackBundle:Acteurs")->find($id);
        $form = $this->createFormBuilder($nouvelActeur)
            ->add('sexe', 'choice', array(
                'choices'   => array(0 => 'Homme', 1 => 'Femme'),
                'expanded'  => true,
            ))
            ->add("prenom", "text")
            ->add("nom", "text")
            ->add("ville", "text")
            ->add("dateNaissance", 'date', [
                'years' => range(date('Y')-100,date('Y'))
            ])
            ->add("fichier", "file", [
                'required' => false
            ])
            ->add("biographie", "textarea")
            ->add("modifier", "submit")
            ->getForm();


        $form->handleRequest($request);
        // die(var_dump($nouveauGenre));
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $nouvelActeur->upload();
            $em->persist($nouvelActeur);

            $em->flush();
            $sessions = $request->getSession();//message flash
            $sessions->getFlashBag()->add("success_acteur", "L'Acteur a bien été modifié");
            return $this->redirect($this->generateUrl("troiswa_back_acteur_modifier", ['id' => $id]));
        }


        return $this->render("TroiswaBackBundle:Main:modifierActeur.html.twig", ["formActeur" => $form->createView()]);
    }

    public function supprimerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $Acteur = $em->getRepository("TroiswaBackBundle:Acteurs")->find($id);

        $em = $this->getDoctrine()->getManager();

        $em->remove($Acteur);
        $em->flush();

        $sessions = $request->getSession();//message flash
        $sessions->getFlashBag()->add("success_acteur", "L'Acteur a bien été supprimer");
        return $this->redirect($this->generateUrl("troiswa_back_acteur"));




    }
}

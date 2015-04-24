<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FilmController extends Controller
{
    public function routeFilmAction()
    {

        $em=$this->getDoctrine()->getManager();//récuperation de doctrine $em(Entitie Manageur, connexion dans le projet)
        $tousLesFilms=$em->getRepository("TroiswaBackBundle:Film")->findAll();



        return $this->render("TroiswaBackBundle:Main:film.html.twig", ["tousLesFilms"=>$tousLesFilms]);
    }

    public function informationAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $unFilm=$em->getRepository("TroiswaBackBundle:Film")->find($id);



        return $this->render("TroiswaBackBundle:Main:infoFilm.html.twig", ["film"=>$unFilm]);
    }


}

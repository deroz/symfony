<?php

namespace Troiswa\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function dashBoardAction()
    {
        return $this->render("TroiswaBackBundle:Main:main.html.twig");
    }

}

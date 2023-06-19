<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FirstController extends AbstractController
{
    #[Route("/test")]
    public function test()
    {
        return $this->render("first.html.twig", [
            "variable" => "From PHP",
            "isOK" => true
        ]);
    }
    #[Route("/exo-twig")]
    public function exoTwig(){
        return $this->render("exo-twig.html.twig", [
            "names" => ["Christophe", "Marco", "Jesus", "Sina"]
        ]);
    }
}
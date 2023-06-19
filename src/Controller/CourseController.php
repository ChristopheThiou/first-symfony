<?php

namespace App\Controller;

use App\Repository\CourseRepo;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    #[Route("/courses")]
    public function courses()
    {
        $cour = new CourseRepo;
        return $this->render("courses.html.twig",[
            "cour"=> $cour->findAll()
        ]);
    }

    #[Route("/single-course/{id}")]
    public function coursesId(int $id)
    {
        $id1 = new CourseRepo;
        return $this->render("single-course.html.twig",[
            "id1"=> $id1->findById($id)
        ]);
    }
}
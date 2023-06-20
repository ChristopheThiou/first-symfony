<?php

namespace App\Controller;

use App\Entity\Course;
use App\Repository\CourseRepo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourseController extends AbstractController
{
    #[Route("/courses")]
    public function courses()
    {
        $cour = new CourseRepo;
        return $this->render("courses.html.twig", [
            "cour" => $cour->findAll()
        ]);
    }

    #[Route("/single-course/{id}")]
    public function coursesId(int $id)
    {
        $id1 = new CourseRepo;
        return $this->render("single-course.html.twig", [
            "id1" => $id1->findById($id)
        ]);
    }
    #[Route("/add-course")]
    public function addCourse(Request $request)
    {
        $add = new CourseRepo;
        $addData = $request->request->all();
        if (count($addData) > 0) {
            $add->persist(new Course(0, $addData['title'], $addData['subject'], $addData['content'], new \DateTime));
        }
        return $this->render("add-course.html.twig");
    }
    #[Route("/update-course/{id}")]
    public function updateCourse(Request $request, int $id)
    {
        $update = new CourseRepo;
        $updateData = $request->request->all();
        if (count($updateData) > 0) {
            $update->update(new Course($id, $updateData['title'], $updateData['subject'], $updateData['content'], new \DateTime));
        }
        return $this->render("update-course.html.twig", [
            "id2" => $update->findById($id)
        ]);
    }
}
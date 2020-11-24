<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/catégory/list", name="Catégory_List")
     */
    public function CatégoryList(CategoryRepository $categoryRepository){
        $categories = $categoryRepository ->findAll();

        return $this->render("catégory.html.twig", [
            'categories' => $categories
        ]);
    }
}
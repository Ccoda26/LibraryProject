<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/category/list", name="Category_List")
     */
    public function CatégoryList(CategoryRepository $categoryRepository){
        $categories = $categoryRepository ->findAll();

        return $this->render("category.html.twig", [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/list/{id}", name="CategoryShow")
     */
    public function CatégoryShow(CategoryRepository $categoryRepository, $id){
        $categories = $categoryRepository ->find($id);

        return $this->render("thecategory.html.twig", [
            'category' => $categories
        ]);
    }
}
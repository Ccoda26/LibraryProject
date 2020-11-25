<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/category/list", name="category_List")
     */

    public function CatégoryList(CategoryRepository $categoryRepository){
        /* findAll() = select * from catégory */
        $categories = $categoryRepository ->findAll();

        return $this->render("category.html.twig", [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/show/{id}", name="categoryShow")
     */

    public function CatégoryShow(CategoryRepository $categoryRepository, $id){
         /* find(critere) = select infos Where param = url */
        $categories = $categoryRepository ->find($id);

        return $this->render("thecategory.html.twig", [
            'category' => $categories
        ]);
    }
}
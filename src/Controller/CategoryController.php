<?php


namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/category/list", name="category_List")
     */

    public function CategoryList(CategoryRepository $categoryRepository){
        /* findAll() = select * from catégory */
        $categories = $categoryRepository ->findAll();

        return $this->render("front/category.html.twig", [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/admin/category/show/{id}", name="categoryShow")
     */

    public function CatégoryShow(CategoryRepository $categoryRepository, $id){
         /* find(critere) = select infos Where param = url */
        $categories = $categoryRepository ->find($id);

        return $this->render("front/thecategory.html.twig", [
            'category' => $categories
        ]);
    }





}
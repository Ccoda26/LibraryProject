<?php


namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("/category/list", name="category_List")
     */

    public function CategoryList(CategoryRepository $categoryRepository){
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
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/category/insert", name="category_insert")
     */

    // entityMangaer et la methodes pour Insert en sql
    public function insertCategory(EntityManagerInterface $entityManager){
        $entityManager = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setTitle('Pink Power');
        $category->setColor("pink");
        $category->setCreationdate(new \DateTime());
        $category->setPublicationdate(new \DateTime());
        $category->setPublished(0);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($category);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->render('categoryInsert.html.twig');

    }

    /**
     * @Route("/update-category/{id}", name="update_category")
     */

    public function updatecategory(categoryRepository $categoryRepository, EntityManagerInterface $entityManager, $id){
        // select l'id pour updates la bonne ligne
        $category = $categoryRepository->find($id);

        $category->setTitle("Le soleil");
        $category->setColor("yellow");

        // pré-enregistre les informations avant l'envoi
        $entityManager->persist($category);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        // envoi les infos vers mon fichier twig pour les afficher
        return $this->render('updatesCategory.html.twig');
    }


}
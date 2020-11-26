<?php


namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
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
     * @Route("/category/insert", name="category_insert")
     */

    public function insertCategory(){
        // createForm methode appartient au abstractController
        // appelle de la classe CategoryType dans dossier form
        // il va recuperer dans la class entité Catégory les types pour obtenir les bon inputs en twig
        $form = $this-> createForm(CategoryType::class);

        // createView methode propre au formulaire pour permettre a twig de recuperer le formulaire
        $formView = $form->createView();

        return $this->render('insertCategory.html.twig',[
            'formView' => $formView
        ]);

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

    /**
     * @param categoryRepository $categoryRepository
     * @param EntityManagerInterface $entityManager
     * @Route("/delete-category/{id}", name="delete_category")
     */

    public function deletecategory(categoryRepository $categoryRepository, $id, EntityManagerInterface $entityManager){

        // select l'id pour updates la bonne ligne
        $category = $categoryRepository->find($id);

        if (!is_null($category)) {
            $entityManager->remove($category);
            $entityManager->flush();
            // ajoute le message d'erreur de types success => action bien prise en compte
            // ajout du message => category est supprimé
            $this->addFlash('success',
                "La category est supprimé !");
        }

        // Le message est pris en compte est trasmis à la method categoryList et donc envoyé au fichier twig
        // -> de la liste des categorys
        return $this->redirectToRoute('category_List');

    }
}
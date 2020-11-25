<?php


namespace App\Controller;



use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryDonnees extends AbstractController
{

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/category/insert", name="category_insert")
     */
    
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

        return $this->render('categoryinsert.html.twig');

    }
}
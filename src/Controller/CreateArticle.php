<?php


namespace App\Controller;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreateArticle extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/article/insert", name="page_insert")
     */

    public function insertArticle(EntityManagerInterface $entityManager){
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle('La plus valus du congo');
        $article->setContent("La congolexicomatisation c'est inndispensable au congo");
        $article->setPicture('https://images-na.ssl-images-amazon.com/images/I/71IHBrW5CiL._AC_SY450_.jpg');
        $article->setCreationdate(new \DateTime());
        $article->setPublicationdate(new \DateTime());
        $article->setPublished(1);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($article);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->render('insertArticle.html.twig');

}

    /**
     * @param ArticleRepository $articleRepository
     * @param EntityManagerInterface $entityManager
     * @Route("/update-article/{id}", name="update_article")
     */

    public function updateArticle(ArticleRepository $articleRepository, EntityManagerInterface $entityManager, $id){

        $article = $articleRepository->find($id);

        $article->setTitle("Le perroquet");
        $article->setContent("Il est beau, il est bon mon perroquet, yen auras pas pour tout le monde");

        $entityManager->persist($article);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->render('updatesArticle.html.twig');
    }
    /**
     * @param ArticleRepository $articleRepository
     * @param EntityManagerInterface $entityManager
     * @Route("/delete-article/{id}", name="delete_article")
     */
    public function deleteArticle(ArticleRepository $articleRepository, $id, EntityManagerInterface $entityManager){


        // select l'id pour updates la bonne ligne
        $article = $articleRepository->find($id);


    if (!is_null($article)){
        $entityManager->remove($article);
        $entityManager->flush();
    }

        return $this->render('deleteArticle.html.twig');
    }
}
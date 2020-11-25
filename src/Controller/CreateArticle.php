<?php


namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InsertDonnees extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route("/article/insert", name="page_insert")
     */

    public function insertArticle(EntityManagerInterface $entityManager){
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle('Aie Aie Aie');
        $article->setContent("le beau paysage que je vois il est beau alors qu'il est beau");
        $article->setPicture('https://cdn.pixabay.com/photo/2016/06/28/01/42/landscape-1483737_960_720.jpg');
        $article->setCreationdate(new \DateTime());
        $article->setPublicationdate(new \DateTime());
        $article->setPublished(0);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($article);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->render('insert.html.twig');

}
}
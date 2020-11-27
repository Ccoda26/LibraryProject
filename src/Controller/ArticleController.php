<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use http\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/article/list", name="article_List")
     */

    /* le 'Repository equivalent SELECT sql permet d'utiliser toutes les methodes find*/
    public function ArticleList(ArticleRepository $articleRepository){
        $article = $articleRepository ->findAll();

        return $this->render("front/articles.html.twig", [
            'articles' => $article
        ]);
    }

    /**
     * @Route("/article/show/{id}", name="articleShow")
     */
    public function TheArticle(ArticleRepository $articleRepository, $id)
    {
        {
            $article = $articleRepository->find($id);

            return $this->render("front/thearticle.html.twig", [
                'article' => $article
            ]);
        }
    }


}
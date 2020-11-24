<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/article/list", name="article-List")
     */

    /* le 'Repository equivalent SELECT sql permet d'utiliser toutes les methodes find*/
    public function ArticleList(ArticleRepository $articleRepository){
        $article = $articleRepository ->findAll();

        return $this->render("article.html.twig", [
            'articles' => $article
        ]);
    }

    /**
     * @Route("/article/list/{id}", name="articleShow")
     */
    public function TheArticle(ArticleRepository $articleRepository, $id)
    {
        {
            $article = $articleRepository->find($id);

            return $this->render("thearticle.html.twig", [
                'article' => $article
            ]);
        }
    }
}
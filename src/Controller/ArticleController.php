<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/article/list", name="article_List")
     */

    /* le 'Repository equivalent SELECT sql permet d'utiliser toutes les methodes find*/
    public function ArticleList(ArticleRepository $articleRepository){
        $article = $articleRepository ->findAll();

        return $this->render("article.html.twig", [
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

            return $this->render("thearticle.html.twig", [
                'article' => $article
            ]);
        }
    }
    /**
     * @Route("/article/insert", name="page_insert")
     */

    public function insertArticle(Request $request){
        // createForm methode appartient au abstractController
        // appelle de la classe CategoryType dans dossier form
        // il va recuperer dans la class entité Catégory les types pour obtenir les bon inputs en twig

        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        // createView methode propre au formulaire pour permettre a twig de recuperer le formulaire
        $formView = $form->createView();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article_List');
        }
        return $this->render('insertArticle.html.twig',[
            'formView' => $formView
        ]);

    }

    /**
     * @Route("/update-article/{id}", name="update_article")
     */

    public function updateArticle(Request $request, Article $article)
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        $formView = $form->createView();

        if ($form->isSubmitted() && $form->isValid()) {
            // va effectuer la requête d'UPDATE en base de données
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_List');
        }

        return $this->render('updatesArticle.html.twig', [
            'formView' => $formView
        ]);
    }

    /**
     * @param ArticleRepository $articleRepository
     * @param EntityManagerInterface $entityManager
     * @Route("/delete-article/{id}", name="delete_article")
     */
    public function deleteArticle(ArticleRepository $articleRepository, $id, EntityManagerInterface $entityManager){


        // select l'id pour updates la bonne ligne
        $article = $articleRepository->find($id);


        if (!is_null($article)) {
            $entityManager->remove($article);
            $entityManager->flush();
            // ajoute le message d'erreur de types success => action bien prise en compte
            // ajout du message => article est supprimé
            $this->addFlash('success',
                "L'article est supprimé !");
        }

        // Le message est pris en compte est trasmis à la method ArticleList et donc envoyé au fichier twig
        // -> de la liste des articles
        return $this->redirectToRoute('article_List');

    }


}
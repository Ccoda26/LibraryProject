<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    public function insertArticle(){
        // createForm methode appartient au abstractController
        // appelle de la classe CategoryType dans dossier form
        // il va recuperer dans la class entité Catégory les types pour obtenir les bon inputs en twig

        $form = $this->createForm(ArticleType::class);
        // createView methode propre au formulaire pour permettre a twig de recuperer le formulaire
        $formView = $form->createView();

        return $this->render('insertArticle.html.twig',[
            'formView' => $formView
        ]);

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
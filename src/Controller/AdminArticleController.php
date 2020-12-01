<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminArticleController extends AbstractController
{

    /**
     * @Route("/admin/article/list", name="admin_article_List")
     */

    /* le 'Repository equivalent SELECT sql permet d'utiliser toutes les methodes find*/
    public function ArticleList(ArticleRepository $articleRepository){
        $article = $articleRepository ->findAll();

        return $this->render("admin/adminArticle.html.twig", [
            'articles' => $article
        ]);
    }
        /**
     * @Route("/admin/article/insert", name="admin_page_insert")
     */

    public function insertArticle(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        // createForm methode appartient au abstractController
        // appelle de la classe CategoryType dans dossier form
        // il va recuperer dans la class entité Catégory les types pour obtenir les bon inputs en twig

        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        // si le formulaire est soumis et valid
        if ($form->isSubmitted() && $form->isValid()) {
        // on recupere l'image du formulaire depuis le champ imageFile
            $imageFileName = $form->get('imageFile')->getData();

            // si on a un un fichier
            if ($imageFileName) {
                // on recupere le nom originel
                $originalFilename = pathinfo($imageFileName->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // pour le sécuriser et la rendre unique $slugger permet de reformuler le nom avant de l'enregistrer
                $safeFilename = $slugger->slug($originalFilename);
                // le nouveau nom d'images prends la reformulation du slugger que l'on concatene avec
                // l'extension de l'image
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFileName->guessExtension();

                // Move the file to the directory where images are stored
                try {
                    // essaye d'envoyer l'images vers le dossier renseigner
                    $imageFileName->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                   // si il trouve pas il nous renvoi un erreur
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imageFile' property to store the file name
                // instead of its contents
                $article->setImageFile($newFilename);
            }
            // si l'image s'enregiste dans notre dossier alors on l'envoi en bdd
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success',
                "L'article est CREATE !");


            return $this->redirectToRoute('admin_article_List');
        }

        // createView methode propre au formulaire pour permettre a twig de recuperer le formulaire
        $formView = $form->createView();

        return $this->render("admin/adminInsertArticle.html.twig", [
            'formView' => $formView
        ]);

    }

    /**
     * @Route("/admin/update/article/{id}", name="admin_update_article")
     */

    public function updateArticle(Request $request,
                                  ArticleRepository $articleRepository,
                                  $id,
                                  EntityManagerInterface $entityManager,
                                  SluggerInterface $slugger
    )
    {
        $article = $articleRepository->find($id);

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // on recupere l'image du formulaire depuis le champ imageFile
            $imageFileName = $form->get('imageFile')->getData();

            // si on a un un fichier
            if ($imageFileName) {
                // on recupere le nom originel
                $originalFilename = pathinfo($imageFileName->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // pour le sécuriser et la rendre unique $slugger permet de reformuler le nom avant de l'enregistrer
                $safeFilename = $slugger->slug($originalFilename);
                // le nouveau nom d'images prends la reformulation du slugger que l'on concatene avec
                // l'extension de l'image
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFileName->guessExtension();

                // Move the file to the directory where images are stored
                try {
                    // essaye d'envoyer l'images vers le dossier renseigner
                    $imageFileName->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                    // si il trouve pas il nous renvoi un erreur
                } catch (FileException $e) {
                    error_log("probleme lors du telechargement du fichier ou le dossier n'est pas trouvé");
                }

                // updates the 'imageFile' property to store the file name
                // instead of its contents
                $article->setImageFile($newFilename);
            }
            // si l'image s'enregiste dans notre dossier alors on l'envoi en bdd
            // va effectuer la requête d'UPDATE en base de données
            $entityManager->persist($article);
            $entityManager->flush();
            $this->addFlash('success',
                "L'article est UPDATE !");

            return $this->redirectToRoute('admin_article_List');
        }

        $formView = $form->createView();

        return $this->render("admin/adminUpdatesArticle.html.twig", [
            'formView' => $formView
        ]);
    }

    /**
     * @param ArticleRepository $articleRepository
     * @param EntityManagerInterface $entityManager
     * @Route("/admin/delete-article/{id}", name="admin_delete_article")
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
        return $this->redirectToRoute("admin_article_List");

    }


}
<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findAll();
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'Espace Administrateur',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/admin/new", name="admin_new")
     */
    public function new(EntityManagerInterface $manager, Request $request)
    {
        //Create new article
        $article = new Article();

        //recover data of the form
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/new.html.twig', [
            'controller_name' => 'crée un nouvel article',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}/delete", name="admin_delete")
     */
    public function delete(Article $article, EntityManagerInterface $manager)
    {
        $manager->remove($article);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }
}

<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

        if ($form->isSubmitted() && $form->isValid()) {
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
     * @Route("/admin/{id}/edit", name="admin_edit")
     */
    public function edit(EntityManagerInterface $manager, Request $request, Article $article)
    {

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($article);
            $manager->flush();
            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/edit.html.twig', [
            'controller_name' => 'modifier le contenu de cet article ?',
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

    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login()
    {
        return $this->render('admin/login.html.twig', [
            'controller_name' => 'connexion'
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute('home');
    }
}

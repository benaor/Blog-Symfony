<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function blog(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        return $this->render('blog/blog.html.twig', [
            'controller_name' => 'Voici tous nos articles',
            'articles' => $articles
        ]);
    }

    /**
     * @route("/blog/{id}/view", name="blog_view")
     */
    public function view(Article $article){
        return $this->render('blog/view.html.twig', [
            'controller_name' => 'bienvenue sur l\'article',
            'article' => $article
        ]);
    }

}

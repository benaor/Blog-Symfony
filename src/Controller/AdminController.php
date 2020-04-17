<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}

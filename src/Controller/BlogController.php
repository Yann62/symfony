<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {

        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/", name="home")
     */

    public function home() {
        return $this->render('blog/home.html.twig', [
            'title' => "bienvenue ici les amis !",
            'age' => 31
        ] );
    }

    /**
     * @Route("/aboutus", name="aboutus")
     */

    public function aboutus() {
        return $this->render('blog/aboutus.html.twig');
    }


    /**
     * @Route("/blog/new", name="blog_create")
     */

    public function create() {

        $article = new Article();

        $form = $this->createFormBuilder($article)
                     ->add('title')   
                     ->add('content')
                     ->add('image')
                     ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()  && $form->isValid()) {
            $article->setCreatedAt(new \DateTime());

            $manager->setpersist($article);
            $manager->flush();

            return $this->redirectToRoute('blog_show', ['id'=> $article->getmygid()]);
        }

        return $this->render('blog/create.html.twig',[
            'formArticle' => $form->createview()
        ]);
    }



    
    /**
     * @Route("/blog/{id}", name="blog_show")
     */


    public function show(Article $article) {
    

        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }

    
}


    
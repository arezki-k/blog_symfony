<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
    /**
     * @Route("/articles", name="blog_articles")
     */
    public function articles(ArticleRepository $repo, Request $request): Response
    {
        $articles = $repo->findAll();
        return $this->render('blog/articles.html.twig',[
            'articles'=>$articles
        ]);
    }
    /**
     * @Route("/article/{id}", name="blog_article")
     */
    public function article(Article $article): Response
    {
        return $this->render('blog/article.html.twig',[
            'article'=>$article
        ]);
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/post/publish", name="blog_article_publish")
     */
    public function publish(EntityManagerInterface $em, Request $request):Response
    {
        $user = $this->getUser();
        $article = new Article();
        $publishForm = $this->createForm( ArticleType::class, $article);
        $publishForm->handleRequest($request);

        if($publishForm->isSubmitted() && $publishForm->isValid()){
            $article->setAuthor($user);
            $article->setPublishedDate(new \DateTime());
            $article->setUpdatedDate(new \DateTime());
            $article->setUrlAlias(md5(uniqid(rand(), true)));
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('blog_article', [
                'id' => $article->getId()
            ]);

        }
        return $this->render('blog/publish.html.twig',[
            'publishForm'=>$publishForm->createView()
        ]);

    }
    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/article/edit/{id}", name="blog_article_edit")
     */
    public function edit(EntityManagerInterface $em, Request $request, Article $article):Response
    {
        $editForm = $this->createForm(ArticleType::class, $article);
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()){

            $article->setUpdatedDate(new \DateTime());
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('blog_article', [
                'id' => $article->getId()
            ]);

        }
        return $this->render('blog/edit.html.twig',[
            'editForm'=>$editForm->createView()
        ]);

    }
    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/article/delete/{id}", name="blog_article_delete")
     */
    public function delete(EntityManagerInterface $em, Request $request, Article $article):Response
    {
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('profile');
    }

    /**
     * @Security("is_granted('ROLE_USER')")
     * @Route("/profile", name="profile")
     */
    public function profile(EntityManagerInterface $em, Request $request, ArticleRepository $repo, UserInterface $user):Response
    {
        $articles = $user->getArticles();
        return $this->render('blog/profile.html.twig', [
            'articles'=>$articles
            ]);   
    }
}

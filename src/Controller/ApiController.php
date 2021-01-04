<?php

namespace App\Controller;

use App\Entity\Article;
use App\Services\Api\ApiService;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/lastArticles", name="api_last_five_articles")
     */
    public function lastFiveArticles(ArticleRepository $repo, ApiService $apiService): Response
    {
        $articles = $repo->findBy([],array('published_date'=>'DESC'),5);
        $serializedArticles = [];
        foreach( $articles as $article){
            array_push($serializedArticles, $apiService->articleSerializer($article));
        }
        return new JsonResponse(['articles' => $serializedArticles, 'items' => count($serializedArticles)]);
    }

    
}

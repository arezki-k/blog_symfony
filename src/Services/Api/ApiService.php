<?php 
namespace App\Services\Api;

use App\Entity\Article;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;



class ApiService
{

protected $articlerepository;
protected $categoryrepository;
protected $userrepository;

public function __construct(ArticleRepository $articleRepo, UserRepository $userRepo, CategoryRepository $categoryRepo)
{
$this->articlerepository = $articleRepo;
$this->userrepository = $userRepo;
$this->categoryrepository = $categoryRepo;
}
public function articleSerializer(Article $article){

    return array(
        'title' => $article->getTitle(),
        'author'=>$this->userrepository->find($article->getAuthor())->getEmail(),
        'content' => $article->getContent(),
        'url_alias' => $article->getUrlAlias(),
        'published_date' => $article->getPublishedDate(),
        'image'=>$article->getImage(),
        'category'=>$this->categoryrepository->find($article->getCategory())->getTitle()
    );
}

}

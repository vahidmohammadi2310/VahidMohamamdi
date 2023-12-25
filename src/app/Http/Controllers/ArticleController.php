<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminArticleInterface;
use App\Interfaces\UserArticleInterface;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    private $adminArticleService;
    private $userArticleService;

    public function __construct(AdminArticleInterface $adminArticleService,
                                UserArticleInterface $userArticleService)
    {
        $this->adminArticleService = $adminArticleService;
        $this->userArticleService = $userArticleService;
    }

    /**
     * list of all articles base on user role
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function listOfArticles()
    {
        if (isAdmin())
            $articles = $this->adminArticleService->indexArticle();
        else
            $articles = $this->userArticleService->indexArticle(Auth::id());

        return view('admin.index',compact('articles'));
    }
}

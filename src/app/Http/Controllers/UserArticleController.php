<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Interfaces\UserArticleInterface;
use Illuminate\Http\Request;

class UserArticleController extends Controller
{
    private $userArticleService;

    public function __construct(UserArticleInterface $userArticleService)
    {
        $this->userArticleService = $userArticleService;
    }

    /**
     * create new article form view
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function createNewArticle()
    {
        return view('user.create');
    }

    /**
     * store new article
     *
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeArticle(CreateArticleRequest $request)
    {
        $this->userArticleService->storeArticle([
            'title' => $request->title,
            'content' => $request->body
        ]);

        return redirect()->route('article.index');
    }

    /**
     * find article and send for edit form
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editArticle($id)
    {
        $article = $this->getArticleInfo($id);
        return view('user.edit',compact('article'));
    }

    /**
     * update existing article in db
     *
     * @param UpdateArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function UpdateArticle(UpdateArticleRequest $request, $id)
    {
        $article = $this->getArticleInfo($id);
        $this->userArticleService->updateArticle(
            [
                'title' => $request->title,
                'content' => $request->body
            ],
            $article
        );

        return redirect()->route('article.index');
    }

    /**
     * display details of article
     *
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function showArticle($id)
    {
        $article = $this->getArticleInfo($id);
        return view('user.show',compact('article'));
    }

    /**
     * find article information
     *
     * @param $id
     * @return \App\Models\Article
     */
    public function getArticleInfo($id)
    {
        return $this->userArticleService->showArticle($id);
    }
}

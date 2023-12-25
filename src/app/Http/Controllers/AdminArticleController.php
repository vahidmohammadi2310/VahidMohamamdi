<?php

namespace App\Http\Controllers;

use App\Interfaces\AdminArticleInterface;
use Carbon\Carbon;

class AdminArticleController extends Controller
{

    private $adminArticleService;

    public function __construct(AdminArticleInterface $adminArticleService)
    {
        $this->adminArticleService = $adminArticleService;
    }

    /**
     * approve draft articles
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approveArticle($id)
    {
        $now_date = Carbon::now();
        $this->adminArticleService->approveArticle($id,$now_date);
        return redirect()->back();
    }

    /**
     * delete article
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteArticle($id)
    {
        $this->adminArticleService->deleteArticle($id);
        return redirect()->back();
    }

    /**
     * history of deleted articles
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function HistoryOfArticles()
    {
        $articles = $this->adminArticleService->articlesHistory();
        return view('admin.history',compact('articles'));
    }

    /**
     * restore deleted article
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreArticle($id)
    {
        $this->adminArticleService->restoreArticle($id);
        return redirect()->back();
    }
}

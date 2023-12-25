<?php

namespace App\Services;

use App\Interfaces\AdminArticleInterface;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AdminArticleService implements AdminArticleInterface
{

    private $articleModel;

    public function __construct(Article $articleModel)
    {
        $this->articleModel = $articleModel;
    }


    /**
     * list of all articles
     *
     * @return Collection
     */
    public function indexArticle(): Collection
    {
        return $this->articleModel->articles()->get();
    }

    /**
     * approve draft article
     *
     * @param $id
     * @param Carbon $date
     * @return Article
     */
    public function approveArticle($id , Carbon $date): Article
    {
        $article = $this->articleModel->findOrFail($id);
        $article->publication_status = 'publish';
        $article->publication_date = $date;
        $article->save();

        return $article;
    }

    /**
     * delete article by id
     *
     * @param $id
     * @return void
     */
    public function deleteArticle($id): void
    {
        $this->articleModel->findOrFail($id)->delete();
    }

    /**
     * list of deleted articles
     *
     * @return Collection
     */
    public function articlesHistory(): Collection
    {
        return $this->articleModel->onlyTrashed()->get();
    }

    /**
     * restore deleted article by id
     *
     * @param int $id
     * @return Article
     */
    public function restoreArticle($id): Article
    {
        $article = $this->articleModel::withTrashed()->find($id);
        $article->restore();

        return $article;
    }
}

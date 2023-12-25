<?php

namespace App\Interfaces;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface AdminArticleInterface
{

    /**
     * list of all articles
     *
     * @return Collection
     */
    public function indexArticle(): Collection;

    /**
     * approve draft article
     *
     * @param $id
     * @param Carbon $date
     * @return Article
     */
    public function approveArticle($id, Carbon $date): Article;

    /**
     * delete article by id
     *
     * @param $id
     * @return void
     */
    public function deleteArticle($id): void;

    /**
     * list of deleted articles
     *
     * @return Collection
     */
    public function articlesHistory(): Collection;

    /**
     * restore deleted article by id
     *
     * @param $id
     * @return Article
     */
    public function restoreArticle($id): Article;
}

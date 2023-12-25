<?php

namespace App\Interfaces;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

interface UserArticleInterface
{

    /**
     * list of all articles
     *
     * @param int $userId
     * @return Collection
     */
    public function indexArticle(int $userId): Collection;

    /**
     * create new article
     *
     * @param array $data
     * @return Article
     */
    public function storeArticle(array $data): Article;

    /**
     * details of article by id
     *
     * @param $id
     * @return Article
     */
    public function showArticle($id): Article;

    /**
     * update existing article by id
     *
     * @param array $data
     * @param Article $article
     * @return Article
     */
    public function updateArticle(array $data, Article $article): Article;
}

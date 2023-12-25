<?php

namespace App\Services;

use App\Interfaces\UserArticleInterface;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class UserArticleService implements UserArticleInterface
{
    private $articleModel;

    public function __construct(Article $articleModel)
    {
        $this->articleModel = $articleModel;
    }

    /**
     * list of all articles
     *
     * @param int $userId
     * @return Collection
     */
    public function indexArticle(int $userId): Collection
    {
        return $this->articleModel->articles()
            ->where('author_id', $userId)
            ->get();
    }

    /**
     * create new article
     *
     * @param array $data
     * @return Article
     */
    public function storeArticle(array $data): Article
    {
        return $this->articleModel->create($data);
    }

    /**
     * details of article by id
     *
     * @param $id
     * @return Article
     */
    public function showArticle($id): Article
    {
        return $this->articleModel->findOrFail($id);
    }

    /**
     * update existing article by id
     *
     * @param array $data
     * @param Article $article
     * @return Article
     */
    public function updateArticle(array $data, Article $article): Article
    {
        $article->update($data);
        return $article;
    }
}

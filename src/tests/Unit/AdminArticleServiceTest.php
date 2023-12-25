<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Services\AdminArticleService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class AdminArticleServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $adminArticleService;
    protected $articleModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->articleModel = new Article();
        $this->adminArticleService = new AdminArticleService(new Article());
    }

    /**
     * Test indexArticle method
     */
    public function testIndexArticle()
    {
        $articles = $this->articleModel::withoutEvents(function () {
            return $this->articleModel::factory()->count(3)->create();
        });

        $result = $this->adminArticleService->indexArticle();
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(3, $result);
    }

    /**
     * Test approveArticle method
     */
    public function testApproveArticle()
    {

        $article = $this->articleModel::withoutEvents(function () {
            return $this->articleModel::factory()->unverified()->create();
        });

        $date = Carbon::now();
        $result = $this->adminArticleService->approveArticle($article->id, $date);

        $this->assertInstanceOf(Article::class, $result);
        $this->assertEquals('publish', $result->publication_status);
        $this->assertEquals($date->toDateTimeString(), $result->publication_date->toDateTimeString());
    }

    /**
     * Test deleteArticle method
     */
    public function testDeleteArticle()
    {
        $article = $this->articleModel::withoutEvents(function () {
            return $this->articleModel::factory()->unverified()->create();
        });

        $this->adminArticleService->deleteArticle($article->id);
        $this->assertSoftDeleted('articles', ['id' => $article->id]);
    }

    /**
     * Test articlesHistory method
     */
    public function testArticlesHistory()
    {
        $article = $this->articleModel::withoutEvents(function () {
            return $this->articleModel::factory()->unverified()->create();
        });

        Article::findOrFail($article->id)->delete();
        $result = $this->adminArticleService->articlesHistory();
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(1, $result);
    }

    /**
     * Test restoreArticle method
     */
    public function testRestoreArticle()
    {
        $article = $this->articleModel::withoutEvents(function () {
            return $this->articleModel::factory()->unverified()->create();
        });
        $article->delete();
        $result = $this->adminArticleService->restoreArticle($article->id);
        $this->assertInstanceOf(Article::class, $result);
        $this->assertFalse($result->trashed());
    }
}

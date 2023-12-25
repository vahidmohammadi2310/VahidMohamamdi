<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\User;
use App\Services\UserArticleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserArticleServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $userArticleService;
    protected $articleModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->articleModel = new Article();
        $this->userArticleService = new UserArticleService($this->articleModel);
    }

    /**
     * Test indexArticle method
     */
    public function testIndexArticle()
    {
        $userId = User::factory()->create()->id;
        $articles = $this->articleModel::withoutEvents(function () {
            return $this->articleModel::factory()->count(3)->create();
        });
        $result = $this->userArticleService->indexArticle($userId);
        $this->assertInstanceOf(Collection::class, $result);

        foreach ($result as $index => $article) {
            $this->assertEquals($articles[$index]->id, $article->id);
            $this->assertEquals($articles[$index]->title, $article->title);
            $this->assertEquals($articles[$index]->author_id, $article->author_id);
            $this->assertEquals($articles[$index]->publication_date, $article->publication_date);
            $this->assertEquals($articles[$index]->publication_status, $article->publication_status);
            $this->assertNotNull($article->author);
            $this->assertEquals($articles[$index]->author->id, $article->author->id);
            $this->assertEquals($articles[$index]->author->name, $article->author->name);
        }
    }

    /**
     * Test showArticle method
     */
    public function testShowArticle()
    {
        $article = $this->articleModel::withoutEvents(function () {
            return $this->articleModel::factory()->unverified()->create();
        });
        $result = $this->userArticleService->showArticle($article->id);
        $this->assertInstanceOf(Article::class, $result);
        $this->assertEquals($article->id, $result->id);
    }

    /**
     * Test storeArticle method
     */
    public function testStoreArticle()
    {
        $this->articleModel->unsetEventDispatcher();
        $userId = User::factory()->create()->id;
        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'author_id' => $userId
        ];

        $result = $this->userArticleService->storeArticle($data);
        $this->assertInstanceOf(Article::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['content'], $result->content);
    }

    /**
     * Test updateArticle method
     */
    public function testUpdateArticle()
    {
        $article = $this->articleModel::withoutEvents(function () {
            return $this->articleModel::factory()->unverified()->create();
        });

        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];

        $result = $this->userArticleService->updateArticle($data, $article);
        $this->assertInstanceOf(Article::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['content'], $result->content);
    }
}

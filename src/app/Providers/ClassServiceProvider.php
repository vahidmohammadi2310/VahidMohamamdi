<?php

namespace App\Providers;

use App\Interfaces\AdminArticleInterface;
use App\Interfaces\UserArticleInterface;
use App\Services\AdminArticleService;
use App\Services\UserArticleService;
use Illuminate\Support\ServiceProvider;

class ClassServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            AdminArticleInterface::class,
            AdminArticleService::class
        );
        $this->app->bind(
            UserArticleInterface::class,
            UserArticleService::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

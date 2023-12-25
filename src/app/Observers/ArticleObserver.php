<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleObserver
{

    /**
     * Handle the Article "creating" event.
     */
    public function creating(Article $article): void
    {
        dd('inja');
        $article->author_id = Auth::id();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'author_id',
        'publication_date',
        'publication_status',
    ];

    /**
     * assign value to fields that has default value
     *
     * @var array
     */
    protected $attributes = [
        'publication_status' => 'draft'
    ];

    /**
     * scope for list of all articles
     *
     * @param $query
     * @return mixed
     */
    public function scopeArticles($query)
    {
        return $query
            ->select('id','title','author_id','publication_date','publication_status')
            ->with('author:id,name');
    }

    /**
     * each articles wrote by one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

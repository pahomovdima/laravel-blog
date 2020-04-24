<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BlogPost extends Model {

    protected $fillable = [
        'category_id',
        'slug',
        'title',
        'excerpt',
        'content_raw',
        'content_html',
        'is_published',
        'user_id',
        'published_at'
    ];

    /**
     * Категория статьи
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category () {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Автор статьи
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user () {
        return $this->belongsTo(User::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

    use SoftDeletes;

    protected $fillable = [
        'post_id',
        'user_id',
        'name',
        'email',
        'comment',
        'is_published',
        'published_at'
    ];

    /**
     * Пост
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post () {
        return $this->belongsTo(BlogPost::class);
    }

}

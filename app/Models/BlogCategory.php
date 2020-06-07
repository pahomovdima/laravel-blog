<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model {

    use SoftDeletes;

    /**
     * id корневой категории
     */
    const ROOT = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'parent_id', 'description'
    ];

    /**
     * Получить родительскую категорию
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory () {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    /**
     * Получить дочернюю категорию
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children () {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Accessor
     *
     * @return mixed|string
     */
    public function getParentTitleAttribute () {
        $title = $this->parentCategory->title ?? ($this->isRoot() ? 'Корень' : '???');

        return $title;
    }

    /**
     * Является ли текущий объект корневым
     *
     * @return bool
     */
    public function isRoot () {
        return $this->id === BlogCategory::ROOT;
    }

}

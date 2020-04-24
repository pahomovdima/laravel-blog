<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Carbon;

class BlogPostObserver {

    /**
     * Обработка перед обновлением записи.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost) {
        //
    }

    /**
     * Обработка перед обновлением записи.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost) {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost) {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost) {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost) {
        //
    }

    /**
     * Если дата публикации не установлена и происходит установка флага - опубликовано,
     * то устанавливаем дату публикации на текущую
     *
     * @param $blogPost
     */
    protected function setPublishedAt ($blogPost) {
        if (!$blogPost->published_at && $blogPost->is_published) {
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * Если поле слаг пустое, то заполняем его конвертацией заголовка.
     *
     * @param $blogPost
     */
    protected function setSlug ($blogPost) {
        if (empty($blogPost->slug)) {
            $blogPost->slug = \Str::slug($blogPost->title);
        }
    }
}

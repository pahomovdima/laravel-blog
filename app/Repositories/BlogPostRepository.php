<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class BlogPostRepository
 *
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить модель для редактирования в админке
     *
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить модель для публичной части
     *
     * @param int $id
     * @return Model
     */
    public function getShow($slug)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'content_html',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        return $this->startConditions()
            ->select($columns)
            ->where('slug', $slug)
//            ->where('is_published', 1)
            ->first();
    }

    /**
     * Получить slug по id поста
     *
     * @param int $id
     * @return Model
     */
    public function getSlugById($id)
    {
        return $this->startConditions()->find($id)->slug;
    }

    /**
     * Получить статьи для вывода пагинатором
     *
     * @param int $nPage
     * @return mixed
     */
    public function getAllWithPaginate($nPage = 25)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            //->with(['category', 'user'])
            ->with(['category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                'user:id,name'
            ])
            ->paginate($nPage);

        return $result;
    }

    /**
     * Получить статьи для вывода пагинатором
     *
     * @param int $nPage
     * @return mixed
     */
    public function getAllInRootCategory($nPage = 10)
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->where('category_id', 1)
            ->where('is_published', 1)
            ->paginate($nPage);

        return $result;
    }
}

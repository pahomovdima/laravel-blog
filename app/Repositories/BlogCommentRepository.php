<?php

namespace App\Repositories;

use App\Models\Comment as Model;

/**
 * Class BlogPostRepository
 *
 * @package App\Repositories
 */
class BlogCommentRepository extends CoreRepository {

    /**
     * @return string
     */
    protected function getModelClass () {
        return Model::class;
    }

    /**
     * Получить модель для редактирования в админке
     *
     * @param int $id
     * @return Model
     */
    public function getEdit ($id) {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить комментарии для вывода пагинатором
     *
     * @param int $nPage
     * @return mixed
     */
    public function getAllWithPaginate ($nPage = 25) {
        $columns = [
            'id',
            'post_id',
            'name',
            'email',
            'is_published',
            'published_at',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            //->with(['category', 'user'])
            ->paginate($nPage);

        return $result;
    }

    /**
     * Получить комментарии для вывода пагинатором
     *
     * @param int $nPage
     * @return mixed
     */
    public function getShow ($postId) {
        $columns = [
            'id',
            'post_id',
            'name',
            'comment',
            'is_published',
            'created_at',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->where('post_id', $postId)
            ->where('is_published', 1)
            ->get();

        return $result;
    }

}

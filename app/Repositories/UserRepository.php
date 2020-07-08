<?php

namespace App\Repositories;

use App\Models\User as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends CoreRepository {

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
     * Получить пользователей для вывода пагинатором
     *
     * @param int|null $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate () {
        $columns = [
            'id',
            'name',
            'email',
            'role_id',
            'created_at'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'ASC')
            ->paginate(25);

        return $result;
    }

}

<?php

namespace App\Repositories;

use App\Models\UserGroup as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserGroupRepository
 *
 * @package App\Repositories
 */
class UserGroupRepository extends CoreRepository {

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
     * Получить группы пользователей для вывода пагинатором
     *
     * @param int|null $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate () {
        $columns = [
            'id',
            'name',
            'created_at'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'ASC')
            ->paginate(25);

        return $result;
    }

    /**
     * Получить список груп пользователей для вывода в выпадающем списке
     *
     * @return Collection
     */
    public function getForComboBox () {
        $columns = implode(', ', [
            'id', 'name'
        ]);

        $result[] = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

}

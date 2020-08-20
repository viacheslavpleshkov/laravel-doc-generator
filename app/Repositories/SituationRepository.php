<?php

namespace App\Repositories;

use App\Models\Situation as Model;

/**
 * Class SituationRepository
 * @package App\Repositories
 */
class SituationRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * SituationRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Model;
    }

    /**
     * @return Model[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @param $attributes
     * @return mixed
     */
    public function update($id, $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param $paginate
     * @return mixed
     */
    public function getAdminAll($paginate)
    {
        $columns = [
            'id',
            'name',
            'description',
            'type_id',
        ];

        $result = $this->model
            ->select($columns)
            ->orderBy('id', 'asc')
            ->with('type:id,name')
            ->paginate($paginate);

        return $result;
    }

    public function getSitenAll($id)
    {
        $columns = [
            'id',
            'name',
            'description',
            'type_id',
        ];

        $result = $this->model
            ->select($columns)
            ->where('type_id', $id)
            ->get();

        return $result;
    }
}
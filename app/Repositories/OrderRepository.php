<?php

namespace App\Repositories;

use App\Models\Order as Model;

/**
 * Class OrderRepository
 * @package App\Repositories
 */
class OrderRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * OrderRepository constructor.
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
            'user_id',
            'situation_id',
            'file_path',
            'price',
            'status',
        ];

        $result = $this->model
            ->select($columns)
            ->orderBy('id', 'asc')
            ->with('user:id,email_pay')
            ->with('situation:id,name')
            ->paginate($paginate);

        return $result;
    }
}
<?php

namespace App\Repositories;

use App\Models\DocumentFile as Model;

/**
 * Class DocumentFileRepository
 * @package App\Repositories
 */
class DocumentFileRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * DocumentFileRepository constructor.
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
     * @param $name
     * @param $name2
     * @return mixed
     */
    public function where($name, $name2)
    {
        return $this->model->where($name, $name2);
    }

    /**
     * @param $paginate
     * @return mixed
     */
    public function getAdminAll($paginate)
    {
        $columns = [
            'id',
            'title',
            'file_path',
            'price'
        ];

        $result = $this->model
            ->select($columns)
            ->orderBy('id', 'asc')
            ->paginate($paginate);

        return $result;
    }
}
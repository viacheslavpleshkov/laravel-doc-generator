<?php

namespace App\Repositories;

use App\Models\Type as Model;

/**
 * Class TypeRepository
 * @package App\Repositories
 */
class TypeRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * TypeRepository constructor.
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
            'url',
        ];

        $result = $this->model
            ->select($columns)
            ->orderBy('id', 'desc')
            ->paginate($paginate);

        return $result;
    }

    public function getSiteAll()
    {
        $columns = [
            'id',
            'name',
            'url',
        ];

        $result = $this->model
            ->select($columns)
            ->orderBy('id', 'asc')
            ->get();

        return $result;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function getSiteUrl($url)
    {
        return $this->model
            ->where('url', $url)
            ->first();
    }
}
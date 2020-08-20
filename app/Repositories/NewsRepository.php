<?php

namespace App\Repositories;

use App\Models\News as Model;

/**
 * Class NewsRepository
 * @package App\Repositories
 */
class NewsRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * NewsRepository constructor.
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

    public function getAdminAll($paginate)
    {
        $columns = [
            'id',
            'title',
            'url',
        ];

        $result = $this->model
            ->select($columns)
            ->orderBy('id', 'asc')
            ->paginate($paginate);

        return $result;
    }

    public function getNewsUrl($url)
    {
        $columns = [
            'id',
            'title',
            'text',
            'url',
        ];

        $result = $this->model
            ->select($columns)
            ->where('url', $url)
            ->first();

        return $result;
    }

    public function getSiteAll() {
        $columns = [
            'id',
            'title',
            'text',
            'url',
        ];

        $result = $this->model
            ->select($columns)
            ->orderBy('id', 'desc')
            ->limit(4)
            ->get();

        return $result;
    }
}
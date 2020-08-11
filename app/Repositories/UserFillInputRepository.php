<?php

namespace App\Repositories;

use App\Models\UserFillInput as Model;

/**
 * Class UserFillInputRepository
 * @package App\Repositories
 */
class UserFillInputRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * UserFillInputRepository constructor.
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

    public function where($name, $name2)
    {
        return $this->model->where($name, $name2);
    }

    /**
     * @param $user_id
     * @param $situation_id
     * @return mixed
     */
    public function getDocumentAll($user_id, $situation_id)
    {
        return $this->model
            ->where('user_id', $user_id)
            ->where('situation_id', $situation_id)
            ->get();
    }

    /**
     * @param $situation_id
     * @param $user_id
     * @return mixed
     */
    public function getSiteSituation($situation_id, $user_id)
    {
        return $this->model
            ->where('user_id', $user_id)
            ->where('situation_id', $situation_id)
            ->get();
    }
}
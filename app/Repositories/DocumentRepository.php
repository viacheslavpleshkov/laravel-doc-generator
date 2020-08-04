<?php

namespace App\Repositories;

use App\Models\Document as Model;

/**
 * Class DocumentRepository
 * @package App\Repositories
 */
class DocumentRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * DocumentRepository constructor.
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
            'document_file_id',
            'title',
            'key',
        ];

        $result = $this->model
            ->select($columns)
            ->orderBy('id', 'desc')
            ->with('documents_files:id,file_path')
            ->paginate($paginate);

        return $result;
    }
}
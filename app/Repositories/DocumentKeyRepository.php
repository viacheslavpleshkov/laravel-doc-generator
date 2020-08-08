<?php

namespace App\Repositories;

use App\Models\DocumentKey as Model;

/**
 * Class DocumentKeyRepository
 * @package App\Repositories
 */
class DocumentKeyRepository implements RepositoryInterface
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * DocumentKeyRepository constructor.
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
     * @param $document
     * @param $paginate
     * @return mixed
     */
    public function getAdminAll($document, $paginate)
    {
        $columns = [
            'id',
            'title',
            'key',
        ];

        $result = $this->model
            ->select($columns)
            ->where('document_file_id', $document)
            ->orderBy('id', 'desc')
            ->with('documentfile:id,file_path')
            ->paginate($paginate);

        return $result;
    }

    public function getSiteSituation($id) {
        $result = $this->model
            ->where('document_file_id', $id)
            ->get();

        return $result;
    }
}
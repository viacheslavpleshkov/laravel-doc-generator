<?php

namespace App\Repositories;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
     * @return mixed
     */
    function getAll();

    /**
     * @param $id
     * @return mixed
     */
    function getById($id);

    /**
     * @param $attributes
     * @return mixed
     */
    function create($attributes);

    /**
     * @param $id
     * @param $attributes
     * @return mixed
     */
    function update($id, $attributes);

    /**
     * @param $id
     * @return mixed
     */
    function delete($id);
}
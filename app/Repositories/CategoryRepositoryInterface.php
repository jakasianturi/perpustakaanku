<?php

namespace App\Repositories;

/**
* Interface CategoryRepositoryInterface
* @package App\Repositories
*/
interface CategoryRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getDetailCategory($data);

    public function getDatatable();

    public function getDataByQuery($data);

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
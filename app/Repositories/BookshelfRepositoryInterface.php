<?php

namespace App\Repositories;

/**
* Interface BookshelfRepositoryInterface
* @package App\Repositories
*/
interface BookshelfRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getDatatable();

    public function getDataByQuery($data);

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
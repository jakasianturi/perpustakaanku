<?php

namespace App\Repositories;

/**
* Interface BorrowRepositoryInterface
* @package App\Repositories
*/
interface BorrowRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getDatatable();

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
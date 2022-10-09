<?php

namespace App\Repositories;

/**
* Interface NewsRepositoryInterface
* @package App\Repositories
*/
interface NewsRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getLast();

    public function getLatest();

    public function getDetailNews($data);

    public function getRelatedNews($data);

    public function getDatatable();

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
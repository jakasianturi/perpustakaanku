<?php

namespace App\Repositories;

/**
* Interface BannerRepositoryInterface
* @package App\Repositories
*/
interface BannerRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getDatatable();

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
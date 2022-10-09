<?php

namespace App\Repositories;

/**
* Interface UserRepositoryInterface
* @package App\Repositories
*/
interface UserRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getDatatable();

    public function getDataByQuery($data);

    public function getDataAdminByQuery($data);

    public function getDataMemberByQuery($data);

    public function isAdmin();

    public function isMember();

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
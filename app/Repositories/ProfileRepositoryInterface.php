<?php

namespace App\Repositories;

/**
* Interface ProfileRepositoryInterface
* @package App\Repositories
*/
interface ProfileRepositoryInterface
{
    public function update($data, $id);

    public function updateAvatar($data, $id);
}
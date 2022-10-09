<?php

namespace App\Repositories;

/**
* Interface MemberBorrowRepositoryInterface
* @package App\Repositories
*/
interface MemberBorrowRepositoryInterface
{
    public function getDatatable();

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
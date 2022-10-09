<?php

namespace App\Repositories;

/**
* Interface ReturnedRepositoryInterface
* @package App\Repositories
*/
interface ReturnedRepositoryInterface
{
    public function getByActive();
    
    public function getByNonactive();

    public function update($data, $id);

    public function delete($id);
}
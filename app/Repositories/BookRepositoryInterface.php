<?php

namespace App\Repositories;

/**
* Interface BookRepositoryInterface
* @package App\Repositories
*/
interface BookRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getDetailBook($data);

    public function getDataAuthorByQuery($data);

    public function getDataPublicationByQuery($data);

    public function getDataPublisherByQuery($data);

    public function searchData($data);

    public function getLatest();

    public function getDatatable();

    public function getDataByQuery($data);

    public function save($data);

    public function update($data, $id);

    public function delete($id);
}
<?php

namespace App\Repositories;

/**
* Interface SettingRepositoryInterface
* @package App\Repositories
*/
interface SettingRepositoryInterface
{
    public function getSetting();

    public function getAbout();

    public function update($data, $id);
}
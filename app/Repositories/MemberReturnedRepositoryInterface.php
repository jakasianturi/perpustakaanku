<?php

namespace App\Repositories;

/**
* Interface MemberReturnedRepositoryInterface
* @package App\Repositories
*/
interface MemberReturnedRepositoryInterface
{
    public function getByActive();
    
    public function getByNonactive();
}
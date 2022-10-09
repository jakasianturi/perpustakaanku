<?php

namespace Services\Member;

use App\Repositories\Eloquent\MemberReturnedRepository;

class ReturnedService
{
    /**
     * @var $memberReturnedRepository
     */
    protected $memberReturnedRepository;

    /**
     * ReturnedService constructor.
     *
     * @param MemberReturnedRepository $memberReturnedRepository
     */
    public function __construct(MemberReturnedRepository $memberReturnedRepository)
    {
        $this->memberReturnedRepository = $memberReturnedRepository;
    }

    /**
     * Get data by active.
     *
     * @return String
     */
    public function getByActive()
    {
        return $this->memberReturnedRepository->getByActive();
    }

    /**
     * Get data by nonactive.
     *
     * @return String
     */
    public function getByNonactive()
    {
        return $this->memberReturnedRepository->getByNonactive();
    }
}
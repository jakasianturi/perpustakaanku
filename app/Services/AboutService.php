<?php

namespace Services;

use App\Repositories\Eloquent\SettingRepository;

class AboutService
{
    /**
     * @var $settingRepository
     */
    protected $settingRepository;

    /**
     * AboutService constructor.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getAbout()
    {
        return $this->settingRepository->getAbout();
    }
}
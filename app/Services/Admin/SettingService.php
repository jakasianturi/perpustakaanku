<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\SettingRepository;

class SettingService
{
    /**
     * @var $settingRepository
     */
    protected $settingRepository;

    /**
     * SettingService constructor.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $setting = $this->settingRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data pengaturan.');
        }

        DB::commit();

        return $setting;
    }
}
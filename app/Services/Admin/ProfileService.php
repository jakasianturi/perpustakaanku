<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\ProfileRepository;

class ProfileService
{
    /**
     * @var $profileRepository
     */
    protected $profileRepository;

    /**
     * ProfileService constructor.
     *
     * @param ProfileRepository $profileRepository
     */
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $profile = $this->profileRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data profil.');
        }

        DB::commit();

        return $profile;
    }

    public function updateAvatar($data, $id)
    {
        DB::beginTransaction();

        try {
            $profile = $this->profileRepository->updateAvatar($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data profil.');
        }

        DB::commit();

        return $profile;
    }
}
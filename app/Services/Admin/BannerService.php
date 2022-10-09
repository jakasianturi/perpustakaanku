<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\BannerRepository;

class BannerService
{
    /**
     * @var $bannerRepository
     */
    protected $bannerRepository;

    /**
     * BannerService constructor.
     *
     * @param BannerRepository $bannerRepository
     */
    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Get all data.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->bannerRepository->getAll();
    }

    /**
     * Get data by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->bannerRepository->getById($id);
    }

    /**
     * Get datatable data.
     *
     * @return String
     */
    public function getDatatable()
    {
        return $this->bannerRepository->getDatatable();
    }

    /**
     * Get data by query.
     *
     * @return String
     */
    public function getDataByQuery($data)
    {
        return $this->bannerRepository->getDataByQuery($data);
    }

    public function save($data)
    {
        $banner = $this->bannerRepository->save($data);

        return $banner;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $banner = $this->bannerRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data banner.');
        }

        DB::commit();

        return $banner;
    }

    /**
     * Delete data by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $banner = $this->bannerRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data banner.');
        }

        DB::commit();

        return $banner;

    }
}
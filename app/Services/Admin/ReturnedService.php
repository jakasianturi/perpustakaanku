<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\ReturnedRepository;

class ReturnedService
{
    /**
     * @var $returnedRepository
     */
    protected $returnedRepository;

    /**
     * ReturnedService constructor.
     *
     * @param ReturnedRepository $returnedRepository
     */
    public function __construct(ReturnedRepository $returnedRepository)
    {
        $this->returnedRepository = $returnedRepository;
    }

    /**
     * Get data by active.
     *
     * @return String
     */
    public function getByActive()
    {
        return $this->returnedRepository->getByActive();
    }

    /**
     * Get data by nonactive.
     *
     * @return String
     */
    public function getByNonactive()
    {
        return $this->returnedRepository->getByNonactive();
    }

    public function save($data)
    {
        $returned = $this->returnedRepository->save($data);

        return $returned;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $returned = $this->returnedRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data pengembalian.');
        }

        DB::commit();

        return $returned;
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
            $returned = $this->returnedRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data pengembalian.');
        }

        DB::commit();

        return $returned;

    }
}
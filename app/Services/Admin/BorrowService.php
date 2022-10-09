<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\BorrowRepository;

class BorrowService
{
    /**
     * @var $borrowRepository
     */
    protected $borrowRepository;

    /**
     * BorrowService constructor.
     *
     * @param BorrowRepository $borrowRepository
     */
    public function __construct(BorrowRepository $borrowRepository)
    {
        $this->borrowRepository = $borrowRepository;
    }

    /**
     * Get all data.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->borrowRepository->getAll();
    }

    /**
     * Get data by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->borrowRepository->getById($id);
    }

    /**
     * Get datatable data.
     *
     * @return String
     */
    public function getDatatable()
    {
        return $this->borrowRepository->getDatatable();
    }

    public function save($data)
    {
        $borrow = $this->borrowRepository->save($data);

        return $borrow;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $borrow = $this->borrowRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data peminjaman.');
        }

        DB::commit();

        return $borrow;
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
            $borrow = $this->borrowRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data peminjaman.');
        }

        DB::commit();

        return $borrow;

    }
}
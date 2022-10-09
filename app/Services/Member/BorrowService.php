<?php

namespace Services\Member;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\MemberBorrowRepository;

class BorrowService
{
    /**
     * @var $memberBorrowRepository
     */
    protected $memberBorrowRepository;

    /**
     * BorrowService constructor.
     *
     * @param BorrowRepository $memberBorrowRepository
     */
    public function __construct(MemberBorrowRepository $memberBorrowRepository)
    {
        $this->memberBorrowRepository = $memberBorrowRepository;
    }

    /**
     * Get datatable data.
     *
     * @return String
     */
    public function getDatatable()
    {
        return $this->memberBorrowRepository->getDatatable();
    }

    public function save($data)
    {
        $borrow = $this->memberBorrowRepository->save($data);

        return $borrow;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $borrow = $this->memberBorrowRepository->update($data, $id);

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
            $borrow = $this->memberBorrowRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data peminjaman.');
        }

        DB::commit();

        return $borrow;

    }
}
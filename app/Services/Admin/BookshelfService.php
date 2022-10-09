<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\BookshelfRepository;

class BookshelfService
{
    /**
     * @var $bookshelfRepository
     */
    protected $bookshelfRepository;

    /**
     * BookshelfService constructor.
     *
     * @param BookshelfRepository $bookshelfRepository
     */
    public function __construct(BookshelfRepository $bookshelfRepository)
    {
        $this->bookshelfRepository = $bookshelfRepository;
    }

    /**
     * Get all data.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->bookshelfRepository->getAll();
    }

    /**
     * Get data by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->bookshelfRepository->getById($id);
    }

    /**
     * Get datatable data.
     *
     * @return String
     */
    public function getDatatable()
    {
        return $this->bookshelfRepository->getDatatable();
    }

    /**
     * Get data by query.
     *
     * @return String
     */
    public function getDataByQuery($data)
    {
        return $this->bookshelfRepository->getDataByQuery($data);
    }

    public function save($data)
    {
        $bookshelf = $this->bookshelfRepository->save($data);

        return $bookshelf;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $bookshelf = $this->bookshelfRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data rak buku.');
        }

        DB::commit();

        return $bookshelf;
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
            $bookshelf = $this->bookshelfRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data rak buku.');
        }

        DB::commit();

        return $bookshelf;

    }
}
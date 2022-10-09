<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\BookRepository;

class BookService
{
    /**
     * @var $bookRepository
     */
    protected $bookRepository;

    /**
     * BookService constructor.
     *
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Get all data.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->bookRepository->getAll();
    }

    /**
     * Get data by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->bookRepository->getById($id);
    }

    /**
     * Get datatable data.
     *
     * @return String
     */
    public function getDatatable()
    {
        return $this->bookRepository->getDatatable();
    }

    /**
     * Get data by query.
     *
     * @return String
     */
    public function getDataByQuery($data)
    {
        return $this->bookRepository->getDataByQuery($data);
    }

    public function save($data)
    {
        $book = $this->bookRepository->save($data);

        return $book;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $book = $this->bookRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data buku.');
        }

        DB::commit();

        return $book;
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
            $book = $this->bookRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data buku.');
        }

        DB::commit();

        return $book;

    }
}
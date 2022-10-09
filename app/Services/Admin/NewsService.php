<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\NewsRepository;

class NewsService
{
    /**
     * @var $newsRepository
     */
    protected $newsRepository;

    /**
     * NewsService constructor.
     *
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Get all data.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->newsRepository->getAll();
    }

    /**
     * Get data by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->newsRepository->getById($id);
    }

    /**
     * Get datatable data.
     *
     * @return String
     */
    public function getDatatable()
    {
        return $this->newsRepository->getDatatable();
    }

    /**
     * Get data by query.
     *
     * @return String
     */
    public function getDataByQuery($data)
    {
        return $this->newsRepository->getDataByQuery($data);
    }

    public function save($data)
    {
        $news = $this->newsRepository->save($data);

        return $news;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $news = $this->newsRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data berita.');
        }

        DB::commit();

        return $news;
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
            $news = $this->newsRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data berita.');
        }

        DB::commit();

        return $news;

    }
}
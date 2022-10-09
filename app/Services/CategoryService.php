<?php

namespace Services;

use App\Repositories\Eloquent\CategoryRepository;

class CategoryService
{
    /**
     * @var $categoryRepository
     */
    protected $categoryRepository;

    /**
     * CategoryService constructor.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Get all data.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get detail data.
     *
     * @return String
     */
    public function getDetailCategory($data)
    {
        return $this->categoryRepository->getDetailCategory($data);
    }

    /**
     * Get data by query.
     *
     * @return String
     */
    public function getDataByQuery($data)
    {
        return $this->categoryRepository->getDataByQuery($data);
    }
}
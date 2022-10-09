<?php

namespace Services;

use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\CategoryRepository;

class BookService
{
    /**
     * @var $bookRepository
     * @var $categoryRepository
     */
    protected $bookRepository;
    protected $categoryRepository;

    /**
     * HomeService constructor.
     *
     * @param BookRepository $bookRepository
     * @param CategoryRepository $categoryRepository
     * @param NewsRepository $newsRepository
     */
    public function __construct(BookRepository $bookRepository, CategoryRepository $categoryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
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

    public function getDetailBook($data)
    {
        return $this->bookRepository->getDetailBook($data);
    }

    public function getRelatedBook($data)
    {
        return $this->bookRepository->getRelatedBook($data);
    }

    public function getCategory()
    {
        return $this->categoryRepository->getAll();
    }

    public function getDataAuthorByQuery($data)
    {
        return $this->bookRepository->getDataAuthorByQuery($data);
    }

    public function getDataPublicationByQuery($data)
    {
        return $this->bookRepository->getDataPublicationByQuery($data);
    }

    public function getDataPublisherByQuery($data)
    {
        return $this->bookRepository->getDataPublisherByQuery($data);
    }

    public function searchData($data)
    {
        return $this->bookRepository->searchData($data);
    }

}
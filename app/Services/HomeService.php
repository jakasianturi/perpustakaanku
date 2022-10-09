<?php

namespace Services;

use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\NewsRepository;
use App\Repositories\Eloquent\BannerRepository;

class HomeService
{
    /**
     * @var $bookRepository
     * @var $bannerRepository
     * @var $newsRepository
     */
    protected $bookRepository;
    protected $bannerRepository;
    protected $newsRepository;

    /**
     * HomeService constructor.
     *
     * @param BookRepository $bookRepository
     * @param BannerRepository $bannerRepository
     * @param NewsRepository $newsRepository
     */
    public function __construct(BookRepository $bookRepository, BannerRepository $bannerRepository, NewsRepository $newsRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->bannerRepository = $bannerRepository;
        $this->newsRepository = $newsRepository;
    }

    public function getAllBanner()
    {
        return $this->bannerRepository->getAll();
    }

    public function getLatestBook()
    {
        return $this->bookRepository->getLatest();
    }

    public function getLatestNews()
    {
        return $this->newsRepository->getLatest();
    }

    public function getLastNews()
    {
        return $this->newsRepository->getLast();
    }

}
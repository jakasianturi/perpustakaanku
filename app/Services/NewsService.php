<?php

namespace Services;

use App\Repositories\Eloquent\NewsRepository;

class NewsService
{
    /**
     * @var $newsRepository
     */
    protected $newsRepository;

    /**
     * BookService constructor.
     *
     * @param NewsRepository $newsRepository
     */
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getDetailNews($data)
    {
        return $this->newsRepository->getDetailNews($data);
    }

    public function getRelatedNews($data)
    {
        return $this->newsRepository->getRelatedNews($data);
    }
}
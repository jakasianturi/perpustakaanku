<?php

namespace App\Http\Controllers;

use App\Models\News;
use Services\NewsService;

class NewsController extends Controller
{
    /**
     * @var NewsService
     */
    protected $newsService;

    /**
     * NewsController Constructor
     *
     *
     */
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function detailNews($slug)
    {
        $news = $this->newsService->getDetailNews($slug);
        $related_news  = $this->newsService->getRelatedNews($slug);

        if(empty($news)) {
            abort(404);
        }
        
        return view('detail_news', compact('news', 'related_news'));
    }
}
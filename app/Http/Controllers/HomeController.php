<?php

namespace App\Http\Controllers;

use Services\HomeService;
use Services\AboutService;

class HomeController extends Controller
{
    /**
     * @var HomeService
     */
    protected $homeService;
    protected $aboutService;

    /**
     * HomeController Constructor
     *
     *
     */
    public function __construct(HomeService $homeService, AboutService $aboutService)
    {
        $this->homeService = $homeService;
        $this->aboutService = $aboutService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = $this->homeService->getAllBanner();
        $books = $this->homeService->getLatestBook();
        $last_news = $this->homeService->getLastNews();
        $news = $this->homeService->getLatestNews();

        return view('home', compact('banners', 'books', 'last_news', 'news'));
    }

    public function about()
    {
        $about = $this->aboutService->getAbout();

        return view('about', compact('about'));
    }
}
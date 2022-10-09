<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\NewsRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\BannerRepositoryInterface;
use App\Repositories\BorrowRepositoryInterface;
use App\Repositories\Eloquent\BannerRepository;
use App\Repositories\Eloquent\BorrowRepository;
use App\Repositories\Eloquent\ProfileRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\SettingRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ReturnedRepository;
use App\Repositories\ReturnedRepositoryInterface;
use App\Repositories\BookshelfRepositoryInterface;
use App\Repositories\Eloquent\BookshelfRepository;
use App\Repositories\Eloquent\MemberBorrowRepository;
use App\Repositories\MemberBorrowRepositoryInterface;
use App\Repositories\Eloquent\MemberReturnedRepository;
use App\Repositories\MemberReturnedRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(BookshelfRepositoryInterface::class, BookshelfRepository::class);
        $this->app->bind(BorrowRepositoryInterface::class, BorrowRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(MemberBorrowRepositoryInterface::class, MemberBorrowRepository::class);
        $this->app->bind(MemberReturnedRepositoryInterface::class, MemberReturnedRepository::class);
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(ReturnedRepositoryInterface::class, ReturnedRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
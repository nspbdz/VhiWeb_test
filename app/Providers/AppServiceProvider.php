<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryImplement;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryImplement;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryImplement;
use App\Repositories\Photo\PhotoRepository;
use App\Repositories\Photo\PhotoRepositoryImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AuthRepository::class,
            AuthRepositoryImplement::class,

        );

        $this->app->bind(
            BlogRepository::class,
            BlogRepositoryImplement::class,

        );
        $this->app->bind(
            CommentRepository::class,
            CommentRepositoryImplement::class,
        );
        $this->app->bind(
            PhotoRepository::class,
            PhotoRepositoryImplement::class,
        );
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

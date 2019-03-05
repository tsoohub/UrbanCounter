<?php
/**
 * Created by PhpStorm.
 * User: tsoodol
 * Date: 1/23/2019
 * Time: 1:16 PM
 */

namespace App\Providers;


use App\Http\Controllers\FormController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\WebsitesController;
use Illuminate\Support\ServiceProvider;

class ControllersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MenusController::class, function(){
            return new MenusController();
        });
        $this->app->bind(WebsitesController::class, function(){
            return new WebsitesController();
        });
        $this->app->bind(PostsController::class, function(){
            return new PostsController();
        });
        $this->app->bind(FormController::class, function(){
            return new FormController();
        });
    }
}
<?php

namespace App\Providers\View\Composer;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use App\Models\Section;

class FrontViewProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['front.layouts.header', 'front.layouts.sidebar'], function ($view) {
            $sections = Section::with(['categories' => function($query){
                $query->where('status', 1)
                ->with(['subcategories' => function($query2){
                    $query2->where('status', 1);
                }]);
            }])
            ->where('status', 1)
            ->get();

            $view->with(['sections' => $sections]);
        });
    }
}

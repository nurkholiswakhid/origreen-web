<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\MapSetting;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('partials.footer', function ($view) {
            $view->with([
                'banner' => Banner::first(),
                'mapSetting' => MapSetting::first(),
                'socialMedia' => SocialMedia::all(),
            ]);
        });
    }
}
<?php

namespace App\Providers;

use App\Composers\ColorsComposer;
use App\Composers\TagsComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'createNote',
            'updateNote',
            'note-list'
        ], ColorsComposer::class);

        view()->composer([
            'createNote',
            'updateNote'
        ], TagsComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

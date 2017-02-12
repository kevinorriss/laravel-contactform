<?php

namespace KevinOrriss\ContactForm;

use Illuminate\Support\ServiceProvider;

class ContactFormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'contactform');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}

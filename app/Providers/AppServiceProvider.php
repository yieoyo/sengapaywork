<?php
namespace App\Providers;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		//\URL::forceRootUrl(\Config::get('app.url')); 
		// and this if you wanna handle https URL scheme too
		/* if (str_contains(\Config::get('app.url'), 'https://')) {
			\URL::forceSchema('https');
		} */
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		\Blade::setRawTags('{{', '}}');
		\Blade::setContentTags('{{{', '}}}');
		\Blade::setEscapedContentTags('{{{', '}}}');
 
    }
	
}

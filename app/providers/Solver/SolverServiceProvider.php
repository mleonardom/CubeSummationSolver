<?php namespace App\Providers\Solver;

use Illuminate\Support\ServiceProvider;

class SolverServiceProvider extends ServiceProvider{
	
	/**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
	
	/**
     * Register the service provider.
     *
     * @return void
     */
	public function register() {
		$this->app['solver'] = $this->app->share(
            function ($app) {
                return new Solver;
            }
        );
	}
	
	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('solver');
	}

}



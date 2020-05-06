<?php
namespace App\Providers;

use App\Helpers\WP;

class AppServiceProvider
{
	protected $providers;
	public function __construct()
	{
		$providers = include WP::getStylesheetDir() . '/src/config/app.php';
		$this->providers = $providers['providers'];
		$this->boot();
	}
	
	public function boot(): void
	{
		foreach ($this->providers as $provider) {
			new $provider();
		}
	}
}

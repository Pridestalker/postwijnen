<?php
namespace App\Providers;

use PostTypes\PostType;

class PostTypeServiceProvider {
	public function __construct()
	{
		$this->boot();
	}
	
	public function boot(): void
	{
		$stores = new PostType('store');
		$stores->icon('dashicons-store');
		$stores->options([
			'supports'      => ['editor', 'title', 'thumbnail']
		]);
		
		$stores->register();
	}
}

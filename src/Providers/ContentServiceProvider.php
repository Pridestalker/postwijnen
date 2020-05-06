<?php
namespace App\Providers;

use Timber\Timber;

class ContentServiceProvider
{
	public function __construct() {
		add_filter('timber/context', [$this, 'boot']);
	}
	
	public function boot($context) {
		$context['stores'] = Timber::get_posts([
			'post_type'     => 'store'
		]);
		
		return $context;
	}
}

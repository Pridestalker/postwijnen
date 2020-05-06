<?php
namespace App\Providers;

class MenuServiceProvider
{
	protected $menus = [
		'primary-menu'      => 'Primary',
	];
	
	public function __construct()
	{
		$this->boot();
	}
	
	public function boot(): void
	{
		\register_nav_menus($this->menus);
		
		add_filter('timber/context', [$this, 'registerContent']);
	}
	
	public function registerContent($content)
	{
		foreach ($this->menus as $key => $name) {
			$content[\App\Helpers\Str::camel($key)] = new \Timber\Menu($key);
		}
		
		return $content;
	}
}

<?php
namespace App;

use App\Providers\ContentServiceProvider;
use App\Providers\CustomizerServiceProvider;
use App\Providers\MenuServiceProvider;
use App\Providers\PostTypeServiceProvider;

return [
	'providers'     => [
	    ContentServiceProvider::class,
        CustomizerServiceProvider::class,
        MenuServiceProvider::class,
        PostTypeServiceProvider::class
    ]
];

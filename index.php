<?php

use Timber\Timber;

$context         = Timber::get_context();
$context['post'] = Timber::get_post();

$templates = [
    'views/page.twig'
];

if (is_checkout()) {
    array_unshift($templates, 'views/woocommerce.html.twig');
}

Timber::render($templates, $context);

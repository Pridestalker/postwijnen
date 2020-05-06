<?php

use Timber\Timber;

$context         = Timber::get_context();
$context['posts'] = new \Timber\PostQuery();

$templates = [
    'views/archive.html.twig',
    'views/page.twig',
];

Timber::render($templates, $context);

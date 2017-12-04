<?php
require __DIR__.'/vendor/autoload.php';
use Timber\Timber;

$container = (new \OCP\Bootstrap)->getContainer();

/** @var $timber Timber */
$timber = $container->get('timber');
$context = $timber::get_context();
$context['post'] = $timber::get_post();
$context['categories'] = Timber::get_terms('category');
$content = $timber::render('base.html.twig', $context);
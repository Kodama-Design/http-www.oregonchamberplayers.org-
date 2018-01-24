<?php
require __DIR__.'/vendor/autoload.php';

$container = (new \OCP\Bootstrap)->getContainer();
(new \OCP\Yoast())->low();
(new \OCP\Jquery())->replace("3.2.1");
(new \OCP\AdminBar())->removeMargin();
(new \OCP\Login())->addInlineStyles("body {color: #fff;}");
(new \OCP\Translate())->loadTextDomain($container->getParameter('translation.path'));
(new \OCP\Thumbnail())->enableUpscale();

// add styles
add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('app', get_stylesheet_directory_uri().'/assets/dist/stylesheets/app.css', ['et-builder-modules-style', 'wp-mediaelement', 'mediaelement'], null);
});

// register menus
register_nav_menus(array(
    'main_menu' => 'Main Menu',
    'footer_menu' => 'Footer Menu',
));

// add main menu to timber
add_filter('timber/context', function($context) {
    $context['main_menu'] = new \Timber\Menu( 'main_menu' );
    $context['footer_menu'] = new \Timber\Menu( 'footer_menu' );

    return $context;
});

// scroll to form when not using ajax
add_filter('gform_confirmation_anchor', '__return_true');
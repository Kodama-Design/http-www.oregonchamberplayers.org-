<?php
namespace OCP;

class Stylesheets
{
    public function addStylesheet()
    {
        add_action('wp_enqueue_scripts', function($handle, $url){
            wp_enqueue_style( 'custom-styling', get_stylesheet_directory_uri() . '/custom.css' );
        });
    }
}
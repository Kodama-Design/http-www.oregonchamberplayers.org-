<?php
namespace OCP;

class Jquery
{
    public function replace(string $version = '3.2.1')
    {
        add_action('init', function() use($version) {
            // only replace if not an admin/login page
            if (!is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
                wp_deregister_script('jquery');
                wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/'.$version.'/jquery.min.js', false, false);
                wp_enqueue_script('jquery');
            }
        });
    }
}
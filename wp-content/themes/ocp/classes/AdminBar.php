<?php
namespace OCP;

class AdminBar
{
    public function removeMargin()
    {
        add_action('get_header', function() {
            remove_action('wp_head', '_admin_bar_bump_cb');
        });
    }
}
<?php
namespace OCP;

class Yoast
{

    public function low()
    {
        add_filter('wpseo_metabox_prio', function(){return 'low';});
    }

    public function normal()
    {
        add_filter('wpseo_metabox_prio', function(){return 'default';});
    }

    public function high()
    {
        add_filter('wpseo_metabox_prio', function(){return 'high';});
    }
}
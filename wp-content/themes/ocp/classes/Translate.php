<?php
namespace OCP;

class Translate
{
    public function loadTextDomain(string $path)
    {
        load_theme_textdomain('supertheme', $path);
    }
}
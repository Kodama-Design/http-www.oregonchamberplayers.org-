<?php
namespace OCP;

class Login
{
    public function addInlineStyles(string $content)
    {
        add_action('login_head', function ($content)  {
            echo "<stye>$content</stye>";
        });
    }
}
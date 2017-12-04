<?php
require __DIR__.'/vendor/autoload.php';

$container = (new \OCP\Bootstrap)->getContainer();
(new \OCP\Yoast())->low();
(new \OCP\Jquery())->replace("3.2.1");
(new \OCP\AdminBar())->removeMargin();
(new \OCP\Login())->addInlineStyles("body {color: #fff;}");
(new \OCP\Translate())->loadTextDomain($container->getParameter('translation.path'));
(new \OCP\Thumbnail())->enableUpscale();
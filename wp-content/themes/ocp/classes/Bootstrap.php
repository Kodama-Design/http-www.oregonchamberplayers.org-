<?php
namespace OCP;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Timber\Timber;

class Bootstrap
{
    private static $container = null;

    public function getContainer()
    {
        if(!self::$container) {
            $container = new ContainerBuilder();
            $container->setParameter('template_dir', get_template_directory());
            $container->setParameter('template_uri', get_template_directory_uri());
            $container->setParameter('WP_DEBUG', WP_DEBUG);

            $loader = new YamlFileLoader($container, new FileLocator(get_template_directory()));
            $loader->load('config/services.yml');

            Timber::$locations = $container->getParameterBag()->resolveValue($container->getParameter('template.paths'));

            self::$container = $container;
        }

        return self::$container;
    }
}
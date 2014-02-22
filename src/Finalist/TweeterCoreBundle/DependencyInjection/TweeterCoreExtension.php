<?php

namespace Finalist\TweeterCoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

use Finalist\TweeterCoreBundle\Repository\Type\IdType;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TweeterCoreExtension extends Extension
{
    const DOCTRINE_DBAL_TYPES_KEY = 'doctrine.dbal.connection_factory.types';
    
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->registerCustomType($container, IdType::ID_TYPE, 'Finalist\TweeterCoreBundle\Repository\Type\IdType');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
    
    private function registerCustomType(ContainerBuilder $container, $id, $typeClassName) {
        $parameter = $container->getParameter(self::DOCTRINE_DBAL_TYPES_KEY);
        $parameter[$id] = [
          'class'=>$typeClassName,
          'commented'=>true
        ];
        $container->setParameter(self::DOCTRINE_DBAL_TYPES_KEY, $parameter);
    }
}

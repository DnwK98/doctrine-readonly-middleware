<?php

declare(strict_types=1);

namespace Dnwk\DoctrineReadonlyMiddleware\DependencyInjection;

use Dnwk\DoctrineReadonlyMiddleware\Readonly\ReadonlyMiddleware;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;

class DoctrineReadonlyMiddlewareExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $definition = new Definition(ReadonlyMiddleware::class);
        $definition->setAutowired(true);
        $definition->setAutoconfigured(true);
        $definition->addTag('doctrine.middleware');

        $container->setDefinition(ReadonlyMiddleware::class, $definition);
    }
}
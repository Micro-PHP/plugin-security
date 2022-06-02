<?php

namespace Micro\Plugin\Security;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Security\Configuration\SecurityPluginConfigurationInterface;
use Micro\Plugin\Security\Facade\SecurityFacade;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;

/**
 * @method SecurityPluginConfigurationInterface configuration()
 */
class SecurityPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(SecurityFacadeInterface::class, function () {
            return $this->createSecurityFacade();
        });
    }

    protected function createSecurityFacade(): SecurityFacadeInterface
    {
        return new SecurityFacade();
    }
}
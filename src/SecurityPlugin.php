<?php

namespace Micro\Plugin\Security;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Plugin\Security\Business\Provider\SecurityProviderFactory;
use Micro\Plugin\Security\Business\Provider\SecurityProviderFactoryInterface;
use Micro\Plugin\Security\Business\Token\Decoder\DecoderFactoryInterface;
use Micro\Plugin\Security\Business\Token\Decoder\JWTDecoderFactory;
use Micro\Plugin\Security\Configuration\SecurityPluginConfigurationInterface;
use Micro\Plugin\Security\Facade\SecurityFacade;
use Micro\Plugin\Security\Facade\SecurityFacadeInterface;
use Micro\Plugin\Security\Business\Token\Encoder\JWTEncoderFactory;
use Micro\Plugin\Security\Business\Token\Encoder\EncoderFactoryInterface;

/**
 * @method SecurityPluginConfigurationInterface configuration()
 */
class SecurityPlugin implements DependencyProviderInterface, ConfigurableInterface
{
    use PluginConfigurationTrait;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->register(SecurityFacadeInterface::class, function () {
            return $this->createSecurityFacade();
        });
    }

    /**
     * @return SecurityFacadeInterface
     */
    protected function createSecurityFacade(): SecurityFacadeInterface
    {
        return new SecurityFacade(
            $this->createSecurityProviderFactory()
        );
    }

    /**
     * @return SecurityProviderFactoryInterface
     */
    protected function createSecurityProviderFactory(): SecurityProviderFactoryInterface
    {
        return new SecurityProviderFactory(
            $this->createEncoderFactory(),
            $this->createDecodeFactory(),
            $this->configuration()
        );
    }

    /**
     * @return EncoderFactoryInterface
     */
    protected function createEncoderFactory(): EncoderFactoryInterface
    {
        return new JWTEncoderFactory();
    }

    /**
     * @return DecoderFactoryInterface
     */
    protected function createDecodeFactory(): DecoderFactoryInterface
    {
        return new JWTDecoderFactory();
    }
}
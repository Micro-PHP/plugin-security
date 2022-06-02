<?php

namespace Micro\Plugin\Security\Business\Provider;

use Micro\Plugin\Security\Business\Token\Context\TokenConfiguration;
use Micro\Plugin\Security\Configuration\Provider\ProviderConfigurationInterface;
use Micro\Plugin\Security\Token\TokenInterface;

class SecurityProvider implements SecurityProviderInterface
{
    /**
     * @param ProviderConfigurationInterface $providerConfiguration
     */
    public function __construct(
        private readonly ProviderConfigurationInterface $providerConfiguration
    )
    {
    }

    public function generateToken(TokenConfiguration $tokenConfiguration): TokenInterface
    {
        // TODO: Implement generateToken() method.
    }

    public function decodeToken(string $encoded): TokenInterface
    {
        // TODO: Implement decodeToken() method.
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getName();
    }
}
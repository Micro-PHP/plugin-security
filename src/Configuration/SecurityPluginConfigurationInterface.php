<?php

namespace Micro\Plugin\Security\Configuration;

use Micro\Plugin\Security\Configuration\Provider\ProviderConfigurationInterface;

interface SecurityPluginConfigurationInterface
{

    const PROVIDER_DEFAULT = 'default';

    /**
     * @return array<string>
     */
    public function getProviderList(): array;

    /**
     * @param string $providerName
     *
     * @return ProviderConfigurationInterface
     */
    public function getProviderConfiguration(string $providerName): ProviderConfigurationInterface;
}
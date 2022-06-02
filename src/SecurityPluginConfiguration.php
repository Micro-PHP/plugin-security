<?php

namespace Micro\Plugin\Security;

use Micro\Framework\Kernel\Configuration\Exception\InvalidConfigurationException;
use Micro\Framework\Kernel\Configuration\PluginConfiguration;
use Micro\Plugin\Security\Configuration\Provider\ProviderConfiguration;
use Micro\Plugin\Security\Configuration\Provider\ProviderConfigurationInterface;
use Micro\Plugin\Security\Configuration\SecurityPluginConfigurationInterface;

class SecurityPluginConfiguration extends PluginConfiguration implements SecurityPluginConfigurationInterface
{
    const CFG_PROVIDER_LIST = 'SECURITY_TOKEN_PROVIDER_LIST';

    /**
     * {@inheritDoc}
     */
    public function getProviderList(): array
    {
        $list = $this->configuration->get(self::CFG_PROVIDER_LIST, [self::PROVIDER_DEFAULT], false);

        return $this->explodeStringToArray($list);
    }

    /**
     * {@inheritDoc}
     */
    public function getProviderConfiguration(string $providerName): ProviderConfigurationInterface
    {
        if(!in_array($providerName, $this->getProviderList())) {
            throw new InvalidConfigurationException(
                printf('Security provider "%s" is defined in the configuration "%s". Available providers: [%s] ',
                    $providerName,
                    self::CFG_PROVIDER_LIST,
                    implode(', ', $this->getProviderList())
                )
            );
        }

        return new ProviderConfiguration($this->configuration, $providerName);
    }
}
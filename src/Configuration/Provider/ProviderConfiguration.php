<?php

namespace Micro\Plugin\Security\Configuration\Provider;

use Micro\Framework\Kernel\Configuration\PluginRoutingKeyConfiguration;

class ProviderConfiguration extends PluginRoutingKeyConfiguration implements ProviderConfigurationInterface
{

    const CFG_PROVIDER_ENC_ALGO = 'SECURITY_TOKEN_PROVIDER_%s_ALGORITHM';
    const CFG_PROVIDER_SECRET_KEY = 'SECURITY_TOKEN_PROVIDER_%s_SECRET';
    const CFG_PROVIDER_PUB_KEY = 'SECURITY_TOKEN_PROVIDER_%s_PUBLIC';
    const CFG_PROVIDER_PASSPHRASE = 'SECURITY_TOKEN_PROVIDER_%s_PASSPHRASE';

    /**
     * {@inheritDoc}
     */
    public function getEncryptionAlgorithm(): string
    {
        return $this->get(self::CFG_PROVIDER_ENC_ALGO, self::ALGO_DEFAULT);
    }

    /**
     * {@inheritDoc}
     */
    public function getSecretKey(): string
    {
        $result = $this->get(self::CFG_PROVIDER_SECRET_KEY);
        if(!$result && $this->getEncryptionAlgorithm() === self::HS256) {
            return self::SECRET_DEFAULT;
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function getPublicKey(): string
    {
        $result = $this->get(self::CFG_PROVIDER_PUB_KEY);
        if(!$result && $this->getEncryptionAlgorithm() === self::HS256) {
            return $this->getSecretKey();
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function getPassphrase(): ?string
    {
        return $this->get(self::CFG_PROVIDER_PASSPHRASE);
    }
}
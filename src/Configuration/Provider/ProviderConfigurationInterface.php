<?php

namespace Micro\Plugin\Security\Configuration\Provider;

interface ProviderConfigurationInterface
{
    const ALGO_EDDSA = 'EdDSA';
    const ALGO_RS256 = 'RS256';
    const HS256 = 'HS256';

    const ALGO_DEFAULT = self::HS256;
    const SECRET_DEFAULT = 'default_secret_phrase';

    /**
     * @return string
     */
    public function getEncryptionAlgorithm(): string;

    /**
     * @return string
     */
    public function getSecretKey(): string;

    /**
     * @return string
     */
    public function getPublicKey(): string;

    /**
     * @return string|null
     */
    public function getPassphrase(): ?string;
}
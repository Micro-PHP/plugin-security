<?php

namespace Micro\Plugin\Security\Business\Token\Encoder;

use Firebase\JWT\JWT;

class JWTEncoder implements EncoderInterface
{
    /**
     * @param string $privateKey
     * @param string $encryptAlgorithm
     * @param string|null $passphrase
     */
    public function __construct(
        private readonly string $privateKey,
        private readonly string $encryptAlgorithm,
        private readonly null|string $passphrase = null,
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function encode(array $tokenData): string
    {
        $privateKey = $this->privateKey;
        if($this->passphrase) {
            $privateKey = openssl_pkey_get_private(
                $this->privateKey,
                $this->passphrase
            );
        }

        return JWT::encode($tokenData, $privateKey, $this->encryptAlgorithm);
    }
}
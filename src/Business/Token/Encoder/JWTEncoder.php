<?php

namespace Micro\Plugin\Security\Token\Encoder;

use Firebase\JWT\JWT;

class JWTEncoder implements EncoderInterface
{
    /**
     * @param string $privateKey
     * @param string $passphrase
     * @param string $encryptAlgorithm
     */
    public function __construct(
        private readonly string $privateKey,
        private readonly string $passphrase,
        private readonly string $encryptAlgorithm,
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
<?php

namespace Micro\Plugin\Security\Business\Provider;

use Micro\Plugin\Security\Business\Token\Decoder\DecoderFactoryInterface;
use Micro\Plugin\Security\Configuration\Provider\ProviderConfigurationInterface;
use Micro\Plugin\Security\Exception\TokenExpiredException;
use Micro\Plugin\Security\Business\Token\Encoder\EncoderFactoryInterface;
use Micro\Plugin\Security\Token\Token;
use Micro\Plugin\Security\Token\TokenInterface;

class SecurityProvider implements SecurityProviderInterface
{
    /**
     * @param EncoderFactoryInterface $encoderFactory
     * @param DecoderFactoryInterface $decoderFactory
     * @param ProviderConfigurationInterface $providerConfiguration
     */
    public function __construct(
        private readonly EncoderFactoryInterface $encoderFactory,
        private readonly DecoderFactoryInterface $decoderFactory,
        private readonly ProviderConfigurationInterface $providerConfiguration,
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function generateToken(array $sourceData, int $lifetime = null): TokenInterface
    {
        $createdAt = time();
        $lifetime = $lifetime ?: $this->providerConfiguration->getLifetimeDefault();

        $tokenContainerData = [
            TokenInterface::TOKEN_PARAM_DATA => $sourceData,
            TokenInterface::TOKEN_PARAM_LIFETIME  => $lifetime,
            TokenInterface::TOKEN_PARAM_CREATED_AT => $createdAt,
        ];

        $generatedTokenString = $this->encoderFactory
            ->create($this->providerConfiguration)
            ->encode($tokenContainerData);

        return $this->createToken(
            $generatedTokenString,
            $createdAt,
            $lifetime,
            $sourceData
        );
    }

    /**
     * {@inheritDoc}
     */
    public function decodeToken(string $encoded): TokenInterface
    {
        $decoded = $this->decoderFactory
            ->create($this->providerConfiguration)
            ->decode($encoded);

        return $this->createToken(
            $encoded,
            createdAt: $decoded[TokenInterface::TOKEN_PARAM_CREATED_AT ],
            lifetime: $decoded[TokenInterface::TOKEN_PARAM_LIFETIME],
            tokenData: (array) $decoded[TokenInterface::TOKEN_PARAM_DATA]
        );
    }

    /**
     * @param string $encoded
     * @param int $createdAt
     * @param int $lifetime
     * @param array $tokenData
     *
     * @return Token
     */
    protected function createToken(string $encoded, int $createdAt, int $lifetime, array $tokenData): TokenInterface
    {
        if($lifetime > 0 && (time() > $lifetime + $createdAt)) {
            throw new TokenExpiredException($encoded);
        }

        return new Token(
            source: $encoded,
            createdAt: $createdAt,
            lifetime: $lifetime,
            parameters: $tokenData
        );
    }
}
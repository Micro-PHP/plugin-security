<?php

namespace Micro\Plugin\Security\Business\Token;

use Micro\Plugin\Security\Business\Token\Context\TokenConfiguration;
use Micro\Plugin\Security\Business\Token\Decoder\DecoderInterface;
use Micro\Plugin\Security\Exception\TokenExpiredException;
use Micro\Plugin\Security\Token\Encoder\EncoderInterface;
use Micro\Plugin\Security\Token\Token;
use Micro\Plugin\Security\Token\TokenInterface;

class TokenFactory implements TokenFactoryInterface
{
    /**
     * @param EncoderInterface $tokenEncoder
     * @param DecoderInterface $tokenDecoder
     */
    public function __construct(
        private readonly EncoderInterface $tokenEncoder,
        private readonly DecoderInterface $tokenDecoder
    )
    {
    }

    /**
     * @param TokenConfiguration $tokenConfiguration
     *
     * @return TokenInterface
     */
    public function createTokenFromConfiguration(TokenConfiguration $tokenConfiguration): TokenInterface
    {
        $lifetime = $tokenConfiguration->getLifetime();
        $createdAt = $tokenConfiguration->getCreatedAt();
        $tokenData = $tokenConfiguration->getParameters();

        $tokenContainerData = [
            TokenInterface::TOKEN_PARAM_DATA => $tokenData,
            TokenInterface::TOKEN_PARAM_LIFETIME  => $lifetime,
            TokenInterface::TOKEN_PARAM_CREATED_AT => $createdAt,
        ];

        $encoded = $this->tokenEncoder->encode($tokenContainerData);

        return $this->createToken($encoded, $createdAt, $lifetime, $tokenData);
    }

    /**
     * @param string $encoded
     * @return TokenInterface
     */
    public function createTokenFromEncodedString(string $encoded): TokenInterface
    {
        $tokenEncodedData = $this->tokenDecoder->decode($encoded);

        $createdAt = $tokenEncodedData[TokenInterface::TOKEN_PARAM_CREATED_AT];
        $lifetime = $tokenEncodedData[TokenInterface::TOKEN_PARAM_LIFETIME];
        $tokenData = $tokenEncodedData[TokenInterface::TOKEN_PARAM_DATA];

        if($lifetime > 0 && (time() > $lifetime + $createdAt)) {
            throw new TokenExpiredException($encoded);
        }

        return $this->createToken($encoded, $createdAt, $lifetime, $tokenData);
    }

    /**
     * @param string $encoded
     * @param int $createdAt
     * @param int $lifetime
     * @param array $tokenData
     *
     * @return Token
     */
    protected function createToken(string $encoded, int $createdAt, int $lifetime, array $tokenData): Token
    {
        return new Token(
            source: $encoded,
            createdAt: $createdAt,
            lifetime: $lifetime,
            parameters: $tokenData
        );
    }
}
<?php

namespace Micro\Plugin\Security\Business\Token;

use Micro\Plugin\Security\Business\Token\Context\TokenConfiguration;
use Micro\Plugin\Security\Token\TokenInterface;

interface TokenFactoryInterface
{
    /**
     * @param TokenConfiguration $tokenConfiguration
     *
     * @return TokenInterface
     */
    public function createTokenFromConfiguration(TokenConfiguration $tokenConfiguration): TokenInterface;

    /**
     * @param string $encoded
     *
     * @return TokenInterface
     */
    public function createTokenFromEncodedString(string $encoded): TokenInterface;
}
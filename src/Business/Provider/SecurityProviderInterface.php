<?php

namespace Micro\Plugin\Security\Business\Provider;


use Micro\Plugin\Security\Token\TokenInterface;

interface SecurityProviderInterface
{
    /**
     * @param array $sourceData
     * @param int|null $lifetime
     *
     * @return TokenInterface
     */
    public function generateToken(array $sourceData, int $lifetime = null): TokenInterface;

    /**
     * @param string $encoded
     *
     * @return TokenInterface
     */
    public function decodeToken(string $encoded): TokenInterface;
}
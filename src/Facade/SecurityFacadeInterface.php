<?php

namespace Micro\Plugin\Security\Facade;

use Micro\Plugin\Security\Token\TokenInterface;

interface SecurityFacadeInterface
{
    /**
     * @param array $content
     * @param string|null $providerName
     * @param int|null $lifeTime
     *
     * @return TokenInterface
     */
    public function generateToken(array $content, string $providerName = null, int $lifeTime = null): TokenInterface;

    /**
     * @param string $encoded
     * @param string|null $providerName
     *
     * @return TokenInterface
     */
    public function decodeToken(string $encoded, string $providerName = null): TokenInterface;
}
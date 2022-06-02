<?php

namespace Micro\Plugin\Security\Facade;

use Micro\Plugin\Security\Token\TokenInterface;

interface SecurityFacadeInterface
{
    /**
     * @param array $parameters
     * @param string|null $tokenGenerator
     *
     * @return TokenInterface
     */
    public function generateToken(array $parameters, string $tokenGenerator = null): TokenInterface;
}
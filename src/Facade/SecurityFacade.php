<?php

namespace Micro\Plugin\Security\Facade;

use Micro\Plugin\Security\Token\TokenInterface;

class SecurityFacade implements SecurityFacadeInterface
{

    public function generateToken(array $parameters, string $tokenGenerator = null): TokenInterface
    {
        // TODO: Implement generateToken() method.
    }
}
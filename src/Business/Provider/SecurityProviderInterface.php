<?php

namespace Micro\Plugin\Security\Business\Provider;


interface SecurityProviderInterface
{
    /**
     * @return string
     */
    public function getName(): string;
}
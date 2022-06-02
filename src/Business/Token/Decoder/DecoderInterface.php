<?php

namespace Micro\Plugin\Security\Business\Token\Decoder;

use Micro\Plugin\Security\Token\TokenInterface;

interface DecoderInterface
{
    /**
     * @param string $encodedToken
     *
     * @return array
     */
    public function decode(string $encodedToken): array;
}
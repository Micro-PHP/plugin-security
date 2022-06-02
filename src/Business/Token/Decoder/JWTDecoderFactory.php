<?php

namespace Micro\Plugin\Security\Business\Token\Decoder;

class JWTDecoderFactory implements DecoderFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(): DecoderInterface
    {
        return new JWTDecoder();
    }
}
<?php

namespace Micro\Plugin\Security\Business\Token\Decoder;

interface DecoderFactoryInterface
{
    /**
     * @return DecoderInterface
     */
    public function create(): DecoderInterface;
}
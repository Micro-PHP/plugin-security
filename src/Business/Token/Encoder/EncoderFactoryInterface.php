<?php

namespace Micro\Plugin\Security\Token\Encoder;

interface EncoderFactoryInterface
{
    /**
     * @return EncoderInterface
     */
    public function create(): EncoderInterface;
}
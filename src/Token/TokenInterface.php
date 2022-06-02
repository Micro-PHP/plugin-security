<?php

namespace Micro\Plugin\Security\Token;


interface TokenInterface
{
    public const TOKEN_PARAM_LIFETIME = 'l';
    public const TOKEN_PARAM_DATA = 'd';
    public const TOKEN_PARAM_CREATED_AT = 't';

    /**
     * @return int
     */
    public function getCreatedAt(): int;

    /**
     * @return int
     */
    public function getLifetime(): int;

    /**
     * @return array
     */
    public function getParameters(): array;

    /**
     * @return string
     */
    public function getSource(): string;
}
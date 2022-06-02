<?php

namespace Micro\Plugin\Security\Token;

class Token implements TokenInterface
{
    /**
     * @param string $source
     * @param int $createdAt
     * @param int $lifetime
     * @param array $parameters
     */
    public function __construct(
        private readonly string $source,
        private readonly int $createdAt,
        private readonly int $lifetime,
        private readonly array $parameters
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * {@inheritDoc}
     */
    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    /**
     * {@inheritDoc}
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * {@inheritDoc}
     */
    public function getSource(): string
    {
        return $this->source;
    }
}
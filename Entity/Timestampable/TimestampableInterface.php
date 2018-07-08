<?php

namespace App\Entity;

use DateTimeInterface;

/**
 * Interface TimestampableInterface
 * @package App\Entity
 */
interface TimestampableInterface
{
    /**
     * @return DateTimeInterface|null
     */
    public function getCreated(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $created
     */
    public function setCreated(?DateTimeInterface $created): void;

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdated(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface|null $updated
     */
    public function setUpdated(?DateTimeInterface $updated): void;
}

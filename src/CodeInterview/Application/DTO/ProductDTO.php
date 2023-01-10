<?php

namespace CodeInterview\Application\DTO;

use CodeInterview\Domain\Entity\Product;
use CodeInterview\Domain\Exceptions\ProductSizeException;
use CodeInterview\Domain\Exceptions\ProductTypeException;
use DateTime;

class ProductDTO
{
    /**
     * @param string $name
     * @param string $description
     * @param string $provider
     * @param float $price
     * @param int $size_x
     * @param int $size_y
     * @param DateTime $activationDate
     */
    public function __construct(
        private string   $name,
        private string   $description,
        private string   $provider,
        private float    $price,
        private int      $size_x,
        private int      $size_y,
        private DateTime $activationDate,

    )
    {
    }

    /**
     * @throws ProductSizeException
     * @throws ProductTypeException
     */
    public function getEntity(): Product
    {
        return Product::build(
            $this->name,
            $this->description,
            $this->provider,
            $this->price,
            $this->size_x,
            $this->size_y,
            $this->activationDate,
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getSizeX(): int
    {
        return $this->size_x;
    }

    /**
     * @return int
     */
    public function getSizeY(): int
    {
        return $this->size_y;
    }

    /**
     * @return DateTime
     */
    public function getActivationDate(): DateTime
    {
        return $this->activationDate;
    }

}

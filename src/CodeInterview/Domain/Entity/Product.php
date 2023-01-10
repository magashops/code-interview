<?php

namespace CodeInterview\Domain\Entity;

use CodeInterview\Domain\Exceptions\ProductSizeException;
use CodeInterview\Domain\Exceptions\ProductTypeException;
use CodeInterview\Domain\ValueObjects\ProductSize;
use DateTime;

class Product
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
     * @param string $name
     * @param string $description
     * @param string $provider
     * @param float $price
     * @param int $size_x
     * @param int $size_y
     * @param DateTime $activationDate
     * @return $this
     * @throws ProductSizeException
     * @throws ProductTypeException
     */
    public function build(
        string   $name,
        string   $description,
        string   $provider,
        float    $price,
        int      $size_x,
        int      $size_y,
        DateTime $activationDate,
    ): self
    {
        if (!is_string($name)) throw new ProductTypeException('Name must be a string');
        if (!is_string($description)) throw new ProductTypeException('Description must be a string');
        if (!is_string($provider)) throw new ProductTypeException('Provider must be a string');
        if (!is_float($price)) throw new ProductTypeException('Price must be a float');
        if (!is_int($size_x) && !is_numeric($size_x)) throw new ProductTypeException('Size X must be a integer');
        if (!is_int($size_y) && !is_numeric($size_y)) throw new ProductTypeException('Size Y must be a integer');
        if (!is_a($activationDate, DateTime::class) && $activationDate !== date_format($activationDate, DATE_ATOM)) throw new ProductTypeException('Activation date must be a datetime in ATOM format');
        if ($size_x > ProductSize::MAX_SIZE) throw new ProductSizeException('Size x is too large. It must be less than or equal to' . ProductSize::MAX_SIZE);
        if ($size_y > ProductSize::MAX_SIZE) throw new ProductSizeException('Size y is too large. It must be less than or equal to' . ProductSize::MAX_SIZE);

        return new self(
            $name,
            $description,
            $provider,
            $price,
            $size_x,
            $size_y,
            $activationDate,
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

    public function toArray(): array
    {
        return [
            'name'           => $this->name,
            'description'    => $this->description,
            'provider'       => $this->provider,
            'price'          => $this->price,
            'size_x'         => $this->size_x,
            'size_y'         => $this->size_y,
            'activationDate' => $this->activationDate,
        ];
    }
}

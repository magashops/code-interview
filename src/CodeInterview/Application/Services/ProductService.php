<?php

namespace CodeInterview\Application\Services;

use CodeInterview\Application\DTO\ProductDTO;
use CodeInterview\Domain\Entity\Product;
use Illuminate\Support\Str;

class ProductService
{
    /**
     * @param ProductDTO $productDTO
     * @return array
     */
    public function run(ProductDTO $productDTO): array
    {

        $product = new Product(
            $productDTO->getName(),
            $productDTO->getDescription(),
            $productDTO->getProvider(),
            $productDTO->getPrice(),
            $productDTO->getSizeX(),
            $productDTO->getSizeY(),
            $productDTO->getActivationDate(),
        );

        $response = $product->toArray();
        $response['name'] = (!Str::contains(strtolower($response['name']), ' de home') && strtolower($response['provider']) === 'home') ? $response['name'] . ' de HOME' : $response['name'];
        return [
            'name' => $response['name'],
            'price' => $response['price'],
            'activation_date' => $response['activationDate']->format(DATE_ATOM),
        ];
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CreatesProductSuccessfully extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function it_creates_product_successfully(): void
    {
        $body = $this->generateValidBodyRequest();

        $response = $this->postJson(
            '/api/product',
            $body
        );

        $response->assertJson(
            [
                "name" => $body['name'],
                "price" => $body['price'],
                "activation_date" => $body['activation_date']
            ]
        );

        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function if_home_provider_given_de_home_must_be_in_name(): void
    {
        $body = $this->generateValidBodyRequest();
        $body["provider"] = "home";

        $response = $this->postJson(
            '/api/product',
            $body
        );

        $response->assertJson(
            [
                "name" => "{$body['name']} de HOME",
                "price" => $body['price'],
                "activation_date" => $body['activation_date']
            ]
        );
    }

    /**
     * @test
     */
    public function bad_request_if_size_above_200(): void
    {
        $body = $this->generateValidBodyRequest();
        $body["size"]["x"] = 201;

        $response = $this->postJson(
            '/api/product',
            $body
        );

        $response->assertStatus(422);

        $body = $this->generateValidBodyRequest();
        $body["size"]["y"] = 201;

        $response = $this->postJson(
            '/api/product',
            $body
        );

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function bad_request_if_price_not_numeric(): void
    {
        $body = $this->generateValidBodyRequest();
        $body["price"] = "asdf";

        $response = $this->postJson(
            '/api/product',
            $body
        );

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function bad_request_if_empty_body_given(): void
    {
        $response = $this->postJson('api/product');
        $response->assertStatus(422);
    }

    private function generateValidBodyRequest(): array
    {
        return [
            "name" => "Colchon SolidBed One",
            "description" => $this->getDescription(),
            "provider" => "other",
            "price" => 399.99,
            "size" => [
                "x" => 180,
                "y" => 190
            ],
            "activation_date" => Carbon::now()->addDays(7)->toAtomString()
        ];
    }

    private function getDescription(): string
    {
        return "El colchón viscosensitive SolidBed One ha sido desarrollado para ofrecer un lecho adaptable pero equilibrado para cualquier tipo de durmiente. La alta densidad de todas sus capas proporcionan un confort equilibrado y duradero.";
    }
}

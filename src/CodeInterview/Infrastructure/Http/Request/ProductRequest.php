<?php

namespace CodeInterview\Infrastructure\Http\Request;

use CodeInterview\Application\DTO\ProductDTO;
use CodeInterview\Domain\ValueObjects\ProductSize;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'            => ['string', 'required'],
            'description'     => ['string', 'required'],
            'provider'        => ['string', 'required'],
            'price'           => ['numeric', 'required', 'decimal:2'],
            'size'            => ['required', 'array'],
            'size.x'          => ['required', 'integer', 'numeric', 'max:' . ProductSize::MAX_SIZE],
            'size.y'          => ['required', 'integer', 'numeric', 'max:' . ProductSize::MAX_SIZE],
            'activation_date' => ['required', 'date'],
        ];
    }

    public function getDTO(): ProductDTO
    {
        $data = $this->validated();
        return new ProductDTO(
            $data['name'],
            $data['description'],
            $data['provider'],
            $data['price'],
            $data['size']['x'],
            $data['size']['y'],
            DateTime::createFromFormat(DATE_ATOM, $data['activation_date'])
        );

    }
}

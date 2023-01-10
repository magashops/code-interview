<?php

namespace CodeInterview\Infrastructure\Http\Controller;

use App\Http\Controllers\Controller;
use CodeInterview\Application\Services\ProductService;
use CodeInterview\Domain\Exceptions\ProductSizeException;
use CodeInterview\Domain\Exceptions\ProductTypeException;
use CodeInterview\Infrastructure\Http\Request\ProductRequest;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $service,
    )
    {
    }

    /**
     * @param ProductRequest $request
     * @return Response
     */
    public function run(ProductRequest $request): Response
    {
        $response = $this->service->run($request->getDTO());
        return new Response($response, Response::HTTP_OK, [JSON_INVALID_UTF8_IGNORE]);
    }

}

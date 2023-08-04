<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class GetProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $repsonse = $this->productService->getAll();
        return response()->json($repsonse);
    }
}

<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ProductService
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll( )
    {
        $products = $this->product->all();
        return $products;
    }

    public function create($data)
    {
        try {
            $this->product->create($data);

            return 'Produto criado com sucesso!';

        } catch (ModelNotFoundException $exception) {
            Log::error('Erro ao tentar registrar uma nova receita');
            throw new CustomException($exception->getMessage());
        }
    }
}

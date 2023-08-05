<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
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
        $cacheKey = 'products';

        $cacheProducts = Cache::get($cacheKey);

        if ($cacheProducts !== null) {
            Log::info('Retrieved products from cache');
            return $cacheProducts;
        }

        $products = $this->product->all();
        Cache::put($cacheKey, $products, 60);

        Log::info('Queried and cached list of products');

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

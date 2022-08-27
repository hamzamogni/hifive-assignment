<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductCategoriesController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    
    }
    public function index(Product $product)
    {
        $categories = $this->productRepository->getProductCategories($product);
        return CategoryResource::collection($categories);
    }
}

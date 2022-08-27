<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
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

    public function store(Product $product, Category $category)
    {
        $this->productRepository->attachCategory($product, $category);

        return response(null, 201);
    }

    public function destroy(Product $product, Category $category)
    {
        $this->productRepository->detachCategory($product, $category);

        return response(null, 200);
    }
}

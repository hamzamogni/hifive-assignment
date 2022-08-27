<?php


namespace App\Repositories\Interfaces;

use App\Models\Category;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getProductCategories(Product $product);

    public function attachCategory(Product $product, Category $category);
}

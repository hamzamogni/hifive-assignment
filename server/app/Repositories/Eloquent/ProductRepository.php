<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;


class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getProductCategories(Product $product)
    {
        return $product->categories;
    }

    public function attachCategory(Product $product, Category $category)
    {
        $product->categories()->attach($category->id);

        return true;
    }
}
<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return Product::orderBy("created_at", "desc")->get();
    }

    public function getProductCategories(Product $product)
    {
        return $product->categories;
    }

    public function attachCategory(Product $product, Category $category)
    {
        $productAlreadyHasCategory = Product::whereRelation("categories", "id", $category->id)->first();

        if ($productAlreadyHasCategory) {
            return;
        }
        
        $product->categories()->attach($category->id);

        return true;
    }

    public function detachCategory(Product $product, Category $category)
    {
        $product->categories()->detach($category->id);

        return true;
        
    }
}